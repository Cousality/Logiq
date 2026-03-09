<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';
    protected $primaryKey = 'ticketID';
    public $incrementing = true;

    protected $fillable = [
        'userID',
        'guest_token',
        'conversationID',
        'status',
        'subject',
        'summary',
    ];
}