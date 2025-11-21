<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'orderItemID';
    public $timestamps = false;

    protected $fillable = [
        'orderID',
        'productID',
        'quantity',
        'priceAtTime',
    ];

    public function basket()
    {
        return $this->belongsTo(Basket::class, 'orderID', 'orderID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }
}
