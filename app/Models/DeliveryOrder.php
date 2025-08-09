<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;
    protected $fillable = ['order_number', 'warehouse_id', 'destination_address', 'customer_name', 'customer_phone', 'status', 'assigned_driver_id', 'created_by', 'approved_by', 'total_items'];
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function items()
    {
        return $this->hasMany(DeliveryOrderItem::class);
    }
    public function driver()
    {
        return $this->belongsTo(User::class, 'assigned_driver_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
