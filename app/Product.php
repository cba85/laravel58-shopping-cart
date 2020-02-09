<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Product extends Model
{
    public $quantity = null;

    protected $appends = [
        'hasLowStock',
        'outOfStock',
        'inStock',
        'quantity'
    ];

    public function getHasLowStockAttribute()
    {
        if ($this->outOfStock) {
            return false;
        }
        return (bool) ($this->stock <= 5);
    }

    public function getOutOfStockAttribute()
    {
        return $this->stock == 0;
    }

    public function getInStockAttribute()
    {
        return $this->stock >= 1;
    }

    public function getHasStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'orders_products')->withPivot('quantity');
    }
}
