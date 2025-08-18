<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;
use Livewire\Component;

class OrderShowLivewire extends Component
{
    public $items, $orders;

    public function mount($id)
    {
        $this->orders = DeliveryOrder::findOrFail($id);
        $this->items = DeliveryOrderItem::where('delivery_order_id', $id)->get();
    }

    public function render()
    {
        return view('pages.order_show')->layout('components.app');
    }
}
