<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }
    public function createdDeliveryOrders()
    {
        return $this->hasMany(DeliveryOrder::class, 'created_by');
    }
    public function approvedDeliveryOrders()
    {
        return $this->hasMany(DeliveryOrder::class, 'approved_by');
    }
    public function assignedDeliveries()
    {
        return $this->hasMany(DeliveryOrder::class, 'assigned_driver_id');
    }
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}
