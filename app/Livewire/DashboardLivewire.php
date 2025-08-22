<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use App\Models\Driver;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardLivewire extends Component
{
    public $order_complete, $order, $warehouse, $driver, $driver_active, $item;
    public $new_order;
    public function mount()
    {
        $this->order_complete = DeliveryOrder::where('status', ['delivered', 'cancelled'])->count();
        $this->order = DeliveryOrder::count();
        $this->warehouse = Warehouse::count();
        $this->driver_active = Driver::with('deliveries')->whereHas('deliveries', function ($q) {
            $q->whereNotIn('status', ['pending', 'cancelled', 'delivered']);
        })->count();


        // dd($this->driver_active);
        $this->driver = Driver::count();
        $this->item = Item::count();
        $this->new_order = DeliveryOrder::latest()->paginate(10)->toArray();
        if (Auth::user()->role === 'staff') {
            $this->item = Item::with('stocks')
                ->whereHas('stocks', function ($q) {
                    $q->where('warehouse_id', Auth::user()->staff->warehouse_id);
                })
                ->count();
        }
    }

    public function render()
    {
        return view('pages.dashboard')->layout('components.app');
    }
}
