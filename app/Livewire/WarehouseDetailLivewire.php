<?php

namespace App\Livewire;

use App\Models\Stock;
use App\Models\Warehouse;
use Livewire\Component;

class WarehouseDetailLivewire extends Component
{
    public $warehouse, $items = [];

    public function mount($id)
    {
        $this->warehouse = Warehouse::where('id', $id)->first();
        $this->items = Stock::with(['item'])->where('warehouse_id', $id)->get();
    }

    public function render()
    {
        return view('pages.warehouse_detail')->layout('components.app');
    }
}
