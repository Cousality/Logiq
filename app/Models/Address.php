<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'addressID';

    protected $fillable = [
        'userID',
        'recipientFirstName',
        'recipientLastName',
        'phone',
        'addressLine1',
        'addressLine2',
        'city',
        'postCode',
        'isDefault',
    ];

    protected $casts = [
        'isDefault' => 'boolean',
        'userID'    => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
