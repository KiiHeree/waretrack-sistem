<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'city', 'phone'];
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function deliveryOrders()
    {
        return $this->hasMany(DeliveryOrder::class);
    }
}
