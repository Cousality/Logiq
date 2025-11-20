<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    public $timestamps = true;

    protected $fillable = [
        'userID',
        'orderStatus',
        'totalAmount',
        'addressID',
    ];

    protected static function booted()
    {
        static::creating(function ($basket) {
            if (!$basket->orderStatus) {
                $basket->orderStatus = 'cart';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function items()
    {
        return $this->hasMany(BasketItem::class, 'orderID', 'orderID');
    }
}
