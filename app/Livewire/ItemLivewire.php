<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ItemLivewire extends Component
{
    use WithFileUploads;

    public $items, $categories, $warehouses, $mode = "create", $showModal = false;
    public $sku, $name, $image_path, $unit, $quantity, $update_quantity = null, $update_quantity_mode, $description, $category_id, $warehouse_id, $item_id;

    public function mount()
    {
        $this->getItem();
    }

    public function getItem()
    {
        $this->items = Item::all();
        $this->categories = Category::all();
        $this->warehouses = Warehouse::all();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->sku = '';
        $this->image_path = '';
        $this->unit = '';
        $this->quantity = '';
        $this->category_id = '';
        $this->warehouse_id = '';
        $this->item_id = '';
    }

    public function openModal($mode, $id = null)
    {
        $this->showModal = true;
        $this->categories = Category::all();
        $this->warehouses = Warehouse::all();
        $this->mode = $mode;
        if ($mode == 'create') {
            $this->resetForm();
        } elseif ($mode == 'edit' || $mode == 'show' && $id) {
            $this->dispatch('updateQuantity');
            $it = Item::findOrFail($id);
            $this->sku = $it->sku;
            $this->name = $it->name;
            $this->description = $it->description;
            $this->image_path = $it->image_path;
            $this->unit = $it->unit;
            $this->category_id = $it->category_id;
            $this->item_id = $it->id;
            $stok = Stock::where('item_id', $id)->first();
            $this->quantity = $stok->quantity;
            $this->warehouse_id = $stok->warehouse_id;
        } else {
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('reinitComponents');
        $this->dispatch('reinitDataTable');
    }

    public function store()
    {
        // dd($this->image_path);
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image_path' => 'required',
            'unit' => 'required',
            'warehouse_id' => 'required',
            'quantity' => 'required',
        ]);

        // sku
        $prefix = strtoupper(substr(str_replace(' ', '', $this->name), 0, 3));

        // Tanggal sekarang (YYYYMMDD)
        $date = now()->format('Ymd');

        // Generate SKU
        $this->sku = $prefix . $date;

        $store = '';
        $store_stock = '';
        $store_stok_tx = '';

        // image
        $image_name = $this->name . '-' . $this->image_path->getClientOriginalName();
        $path = $this->image_path->storeAs('image_item', $image_name, 'public');

        $store = Item::create([
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'image_path' => $path,
            'unit' => $this->unit,
        ]);



        if ($store) {
            $store_stock = Stock::create([
                'warehouse_id' => $this->warehouse_id,
                'item_id' => $store->id,
                'quantity' => $this->quantity,
            ]);
            if ($store_stock) {
                $store_stok_tx = StockTransaction::create([
                    'stock_id' => $store_stock->id,
                    'user_id' => Auth::user()->id,
                    'type' => 'in',
                    'qty' => $this->quantity,
                    'note' => 'Tambah Item Baru',
                    'reference_id' => $store->id,
                ]);
            }
        }

        if ($store != '' || $store != null && $store_stock != '' || $store_stock != null && $store_stok_tx != '' || $store_stok_tx != null) {
            session()->flash('success', 'Berhasil menambah data category');
            $this->closeModal();
            $this->getItem();
        } else {
            session()->flash('error', 'Gagal menambah data Item');
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'unit' => 'required',
            'warehouse_id' => 'required',
        ]);
        $update = Item::findOrFail($this->item_id);
        $update_stock = Stock::where('item_id', $this->item_id)->first();
        $store_stok_tx = '';

        // image
        $path = $update->image_path;

        if ($this->image_path != null && $this->image_path != '' && $this->image_path != $path) {
            Storage::disk('public')->delete($update->image_path);
            $image_name = time() . '-' . $this->image_path->getClientOriginalName();
            $path = $this->image_path->storeAs('image_item', $image_name, 'public');
        }

        $update->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'image_path' => $path,
            'unit' => $this->unit,
        ]);

        $quantity_up = 0;
        $type = '';
        if ($this->update_quantity != null || $this->update_quantity != '') {
            // hitung stok
            if ($this->update_quantity_mode === 'tambah') {
                $quantity_up = $update_stock->quantity + $this->update_quantity;
                $type = 'in';
            } else if ($this->update_quantity_mode === 'kurang') {
                $type = 'out';
                $quantity_up = $update_stock->quantity - $this->update_quantity;
            }

            //update stok
            if ($update) {
                $update_stock->update([
                    'warehouse_id' => $this->warehouse_id,
                    'quantity' => $quantity_up,
                ]);
                if ($update_stock) {
                    $store_stok_tx = StockTransaction::create([
                        'stock_id' => $update_stock->id,
                        'user_id' => Auth::user()->id,
                        'type' => $type,
                        'qty' => $quantity_up,
                        'note' => $this->update_quantity_mode . ' quantity item ',
                        'reference_id' => $update->id,
                    ]);

                    if ($store_stok_tx) {
                        session()->flash('success', 'Berhasil mengubah data Item');
                        $this->closeModal();
                        $this->getItem();
                    } else {
                        session()->flash('error', 'Gagal mengubah data Item');
                    }
                }
            }
        }


        if ($update != '' || $update != null && $update_stock != '' || $update_stock != null && $store_stok_tx != '' || $store_stok_tx != null) {
            session()->flash('success', 'Berhasil mengubah data Item');
            $this->closeModal();
            $this->getItem();
        } else {
            session()->flash('error', 'Gagal mengubah data Item');
        }
    }

    public function delete($id)
    {
        $delete = Item::findOrFail($id);
        Storage::disk('public')->delete($delete->image_path);

        $delete_stock = Stock::where('item_id', $id)->first();
        // delete stok tx
        $delete_stock_tx = StockTransaction::where('stock_id', $delete_stock->id)->delete();
        // delete stok
        $delete_stock->delete();
        // delete item
        $delete->delete();

        if ($delete && $delete_stock && $delete_stock_tx) {
            session()->flash('success', 'Berhasil menghapus data item');
            $this->dispatch('closeModal');
            $this->getItem();
        } else {
            session()->flash('error', 'Gagal menghapus data item');
        }
    }

    public function render()
    {
        return view('pages.item')->layout('components.app');
    }
}
