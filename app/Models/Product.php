<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'productID';
    
    protected $fillable = [
        'productName',
        'productSlug',
        'productCategory',
        'productDifficulty',
        'productPrice',
        'productDescription',
        'productImage',
        'productQuantity',
        'productStatus'
    ];
    
    protected $casts = [
        'productPrice' => 'decimal:2',
        'productQuantity' => 'integer'
    ];
}