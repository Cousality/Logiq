<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatConversation extends Model
{
    protected $table = 'chat_conversations';
    protected $primaryKey = 'conversationID';
    public $incrementing = true;

    protected $fillable = [
        'userID',
        'guest_token',
        'channel',
        'last_activity_at',
    ];

    protected $casts = [
        'last_activity_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversationID', 'conversationID');
    }
}