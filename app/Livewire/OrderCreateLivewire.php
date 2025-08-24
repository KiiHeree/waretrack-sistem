<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;
use App\Models\Item;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QrCode as ModelQrCode;
use App\Models\Stock;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderCreateLivewire extends Component
{
    public $warehouses, $items;
    public $customer_name, $customer_phone, $destination_address, $warehouse_id, $item_id = [], $qty = [];
    public $itemsForm = [];

    public function mount()
    {
        $this->warehouses = Warehouse::all();
    }

    public function addItemField()
    {
        $this->items = Stock::where('warehouse_id', $this->warehouse_id)->get();

        $this->itemsForm[] = [
            'item_id' => '',
            'qty' => 1
        ];
    }

    public function removeItemField($index)
    {
        unset($this->itemsForm[$index]);
        $this->itemsForm = array_values($this->itemsForm); // reindex array
    }

    public function generateQr($id)
    {
        $order = DeliveryOrder::findOrFail($id);

        // URL tujuan kalo QR di-scan
        $url = route('order-show', $order->id);

        // Path simpan file
        $fileName = "order-{$order->id}.svg";
        $path = storage_path("app/public/qrcodes/{$fileName}");

        // Bikin folder kalo belum ada
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Generate QR jadi PNG + simpan
        QrCode::format('svg')
            ->size(300)
            ->margin(2)
            ->generate($url, $path);

        // Simpen path ke database (opsional, kalo mau dipanggil lagi)
        $store_qr = ModelQrCode::create([
            'qr_path' => $fileName
        ]);
    }

    public function store()
    {
        $this->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'destination_address' => 'required',
            'warehouse_id' => 'required',
            'itemsForm' => 'required',
        ]);

        // order number
        $prefix = strtoupper(substr(str_replace(' ', '', $this->customer_name), 0, 3));
        $date = now()->format('His');
        $order_number = $prefix . $date;


        $create_order = DeliveryOrder::create([
            'order_number' => $order_number,
            'warehouse_id' => $this->warehouse_id,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'destination_address' => $this->destination_address,
            'status' => 'pending',
            'created_by' => Auth::user()->id,
            'total_items' => count($this->itemsForm)
        ]);
        $create_order_item = false;

        if ($create_order) {
            foreach ($this->itemsForm as $item) {
                $itemId = $item['item_id'] ?? null;
                $qty = $item['qty'] ?? 0;

                if ($itemId && $qty > 0) {
                    $create_order_item = DeliveryOrderItem::create([
                        'delivery_order_id' => $create_order->id,
                        'item_id' => $itemId,
                        'qty' => $qty,
                    ]);

                    $update_stok = Stock::where('item_id', $itemId)->first();
                    $update_stok->update([
                        'quantity' => $update_stok->quantity - $qty,
                    ]);

                    $store_stok_tx = StockTransaction::create([
                        'stock_id' => $update_stok->id,
                        'user_id' => Auth::user()->id,
                        'type' => 'out',
                        'qty' => $qty,
                        'note' => 'Mengurangi Stok Item',
                        'reference_id' => $itemId,
                    ]);
                }
            }

            if ($create_order_item) {
                $this->generateQr($create_order->id);
                return redirect()->route('order')->with('success', 'Berhasil membuat order');
            }
        } else {
            session()->flash('error', 'Gagal membuat order');
        }
    }

    public function render()
    {
        return view('pages.order_create')->layout('components.app');
    }
}
