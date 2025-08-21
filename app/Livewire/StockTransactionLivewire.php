<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\StockTransaction;
use Livewire\Component;

class StockTransactionLivewire extends Component
{
    public $item, $stock_transaction;

    public function mount($id)
    {
        $this->item = Item::where('id', $id)->first();
        $this->stock_transaction = StockTransaction::where('reference_id',$id)->get();
    }

    public function render()
    {
        return view('pages.stock_transaction')->layout('components.app');
    }
}