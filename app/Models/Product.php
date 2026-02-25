<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Review;

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
        'productStatus',
    ];

    protected $casts = [
        'productPrice' => 'decimal:2',
        'productQuantity' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->productSlug)) {
                $base = Str::slug($product->productName);
                $slug = $base;
                $i = 1;
                while (static::where('productSlug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $product->productSlug = $slug;
            }
        });
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->productImage) return '';
        // New uploads are stored as products/filename.jpg on the public disk
        if (str_starts_with($this->productImage, 'products/')) {
            return asset('storage/' . $this->productImage);
        }
        // Legacy paths (e.g. /Images/...) are public directory assets
        return asset($this->productImage);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'productID', 'productID');
    }
}
