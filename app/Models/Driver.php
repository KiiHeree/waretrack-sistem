<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'license_no', 'vehicle_info', 'phone'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveries()
    {
        return $this->hasMany(DeliveryOrder::class, 'assigned_driver_id');
    }
}
