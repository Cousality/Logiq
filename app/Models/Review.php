<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'reviewID';

    protected $fillable = [
        'userID',
        'productID',
        'rating',
        'reviewComment',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'userID' => 'integer',
        'productID' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }
}
