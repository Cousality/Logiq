<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';
    protected $primaryKey = 'messageID';
    public $incrementing = true;

    protected $fillable = [
        'conversationID',
        'role',
        'content',
        'tool_name',
        'tool_payload',
    ];

    protected $casts = [
        'tool_payload' => 'array',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'conversationID', 'conversationID');
    }
}