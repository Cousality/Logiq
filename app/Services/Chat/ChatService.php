<?php

namespace App\Services\Chat;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Contracts\Auth\Authenticatable;

class ChatService
{
    public function __construct(
        private readonly OpenAIClient $openai,
        private readonly ChatTools $tools
    ) {}

    public function handle(ChatConversation $conversation, string $userText, ?Authenticatable $user): array
    {
        $ticket = null;

        $this->saveMsg($conversation->conversationID, 'user', $userText);

        $history = $this->buildHistory($conversation);

        for ($i = 0; $i < 4; $i++) {

            $resp = $this->openai->chat([
                'model' => config('services.openai.model'),
                'temperature' => 0.2,
                'messages' => $history,
                'tools' => $this->toolSchema(),
            ]);

            $msg = $resp['choices'][0]['message'] ?? null;
            if (!$msg) {
                throw new \RuntimeException('Invalid OpenAI response: missing message.');
            }

            if (!empty($msg['tool_calls'])) {

                $history[] = [
                    'role' => 'assistant',
                    'content' => $msg['content'] ?? '',
                    'tool_calls' => $msg['tool_calls'],
                ];

                $this->saveMsg($conversation->conversationID, 'assistant', (string)($msg['content'] ?? ''));

                foreach ($msg['tool_calls'] as $call) {
                    $toolName = $call['function']['name'] ?? '';
                    $argsJson = $call['function']['arguments'] ?? '{}';
                    $args = json_decode($argsJson, true) ?: [];

                    $result = $this->runTool($toolName, $args, $conversation, $user);

                    if (isset($result['ticket_id'])) {
                        $ticket = $result;
                    }

                    $this->saveTool($conversation->conversationID, $toolName, $args, $result);

                    $history[] = [
                        'role' => 'tool',
                        'tool_call_id' => $call['id'],
                        'content' => json_encode($result, JSON_UNESCAPED_UNICODE),
                    ];
                }

                continue;
            }
            $assistant = (string)($msg['content'] ?? '');
            $this->saveMsg($conversation->conversationID, 'assistant', $assistant);

            $conversation->forceFill(['last_activity_at' => now()])->save();

            return [
                'assistant_message' => $assistant,
                'ticket' => $ticket,
            ];
        }

        $fallback = 'I could not complete that automatically. Tell me your issue and I will escalate to support.';
        $this->saveMsg($conversation->conversationID, 'assistant', $fallback);

        return [
            'assistant_message' => $fallback,
            'ticket' => $ticket,
        ];
    }

    private function buildHistory(ChatConversation $conversation): array
    {
        $history = [[
            'role' => 'system',
            'content' => implode("\n", [
                "You are LOGIQ support.",
                "Rules:",
                "- Never reveal private data.",
                "- For order questions, call tools.",
                "- If user requests a human, create a support ticket.",
                "- Keep responses concise.",
            ]),
        ]];

        $dbMsgs = ChatMessage::query()
            ->where('conversationID', $conversation->conversationID)
            ->whereIn('role', ['system', 'user', 'assistant'])
            ->orderBy('created_at')
            ->limit(30)
            ->get();

        foreach ($dbMsgs as $m) {
            $history[] = [
                'role' => $m->role,
                'content' => $m->content ?? '',
            ];
        }

        return $history;
    }

    private function toolSchema(): array
    {
        return [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'list_my_orders',
                    'description' => 'List recent orders for the authenticated user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => new \stdClass(),
                        'additionalProperties' => false,
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_order_status',
                    'description' => 'Get order status and items for a specific orderID belonging to the authenticated user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'order_id' => ['type' => 'integer'],
                        ],
                        'required' => ['order_id'],
                        'additionalProperties' => false,
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'create_support_ticket',
                    'description' => 'Create a support ticket for a human agent.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'subject' => ['type' => 'string'],
                            'summary' => ['type' => 'string'],
                        ],
                        'required' => ['subject', 'summary'],
                        'additionalProperties' => false,
                    ],
                ],
            ],
        ];
    }

    private function runTool(string $name, array $args, ChatConversation $conversation, ?Authenticatable $user): array
    {
        return match ($name) {
            'list_my_orders' => $this->tools->listMyOrders($conversation, $user),
            'get_order_status' => $this->tools->getOrderStatus(
                $conversation,
                $user,
                isset($args['order_id']) ? (int)$args['order_id'] : 0
            ),
            'create_support_ticket' => $this->tools->createSupportTicket(
                $conversation,
                $user,
                (string)($args['subject'] ?? 'Support request'),
                (string)($args['summary'] ?? 'User requested support.')
            ),
            default => ['error' => 'Unknown tool'],
        };
    }

    private function saveMsg(int $conversationID, string $role, string $content): void
    {
        ChatMessage::create([
            'conversationID' => $conversationID,
            'role' => $role,
            'content' => $content,
        ]);
    }

    private function saveTool(int $conversationID, string $toolName, array $args, array $result): void
    {
        ChatMessage::create([
            'conversationID' => $conversationID,
            'role' => 'tool',
            'tool_name' => $toolName,
            'tool_payload' => [
                'args' => $args,
                'result' => $result,
            ],
            'content' => null,
        ]);
    }
}