<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'promotionID';

    protected $fillable = ['promotionCode', 'discountType', 'discountValue'];
}
