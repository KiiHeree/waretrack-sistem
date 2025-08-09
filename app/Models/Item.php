<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['sku', 'name', 'category_id', 'description', 'image_path', 'min_stock', 'unit'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function deliveryOrderItems()
    {
        return $this->hasMany(DeliveryOrderItem::class);
    }
    public function transactions()
    {
        return $this->hasManyThrough(StockTransaction::class, Stock::class, 'item_id', 'stock_id', 'id', 'id');
    }
}
