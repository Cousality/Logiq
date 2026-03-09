<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\SupportTicket;
use App\Services\Chat\ChatService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    public function send(Request $request, ChatService $chat): array
    {
        $data = $request->validate([
            'conversation_id' => ['nullable', 'integer'],
            'message' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $conversation = $this->resolveConversation($request, $data['conversation_id'] ?? null);

        $result = $chat->handle($conversation, $data['message'], $request->user());

        return [
            'conversation_id' => $conversation->conversationID,
            'assistant_message' => $result['assistant_message'],
            'ticket' => $result['ticket'] ?? null,
        ];
    }

    public function escalate(Request $request): array
    {
        $data = $request->validate([
            'conversation_id' => ['required', 'integer'],
            'subject' => ['required', 'string', 'min:3', 'max:120'],
            'summary' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        $conversation = ChatConversation::query()->findOrFail($data['conversation_id']);

        $this->assertOwnsConversation($request, $conversation);

        $ticket = SupportTicket::create([
            'userID' => $request->user()?->getAuthIdentifier(),
            'guest_token' => $request->user() ? null : $request->cookie('chat_guest_token'),
            'conversationID' => $conversation->conversationID,
            'status' => 'open',
            'subject' => $data['subject'],
            'summary' => $data['summary'],
        ]);

        return ['ticket_id' => $ticket->ticketID, 'status' => $ticket->status];
    }

    private function resolveConversation(Request $request, ?int $conversationID): ChatConversation
    {
        if ($conversationID) {
            $conv = ChatConversation::query()->findOrFail($conversationID);
            $this->assertOwnsConversation($request, $conv);
            return $conv;
        }

        return ChatConversation::create([
            'userID' => $request->user()?->getAuthIdentifier(),
            'guest_token' => $request->user() ? null : $request->cookie('chat_guest_token'),
            'channel' => 'web',
            'last_activity_at' => now(),
        ]);
    }

    private function assertOwnsConversation(Request $request, ChatConversation $conversation): void
    {
        $user = $request->user();
        $guest = $request->cookie('chat_guest_token');

        $owned = $user
            ? ((int)$conversation->userID === (int)$user->getAuthIdentifier())
            : (is_string($guest) && $conversation->guest_token === $guest);

        if (!$owned) {
            throw ValidationException::withMessages(['conversation_id' => 'Invalid conversation.']);
        }
    }
}