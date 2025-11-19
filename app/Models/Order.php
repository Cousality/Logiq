<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'orderID';

    protected $fillable = [
        'userID',
        'orderDate',
        'orderStatus',
        'totalAmount',
    ];

    protected $casts = [
        'orderDate' => 'datetime',
        'totalAmount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderID', 'orderID');
    }
}
