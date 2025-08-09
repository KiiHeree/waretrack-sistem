<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['delivery_order_id', 'item_id', 'qty'];
    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
