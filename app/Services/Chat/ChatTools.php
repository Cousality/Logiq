<?php

namespace App\Services\Chat;

use App\Models\ChatConversation;
use App\Models\SupportTicket;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class ChatTools
{
    public function listMyOrders(ChatConversation $conversation, ?Authenticatable $user): array
    {
        if (!$user) return ['error' => 'Log in to view your orders.'];

        $orders = DB::table('orders')
            ->where('userID', $user->getAuthIdentifier())
            ->where('orderStatus', '!=', 'cart')
            ->orderByDesc('orderDate')
            ->limit(10)
            ->get([
                'orderID as order_id',
                'orderStatus as status',
                'totalAmount as total',
                'orderDate as order_date',
            ]);

        return ['orders' => $orders];
    }

    public function getOrderStatus(ChatConversation $conversation, ?Authenticatable $user, int $orderId): array
    {
        if (!$user) return ['error' => 'Log in to view your order status.'];

        $order = DB::table('orders')
            ->where('orderID', $orderId)
            ->where('userID', $user->getAuthIdentifier())
            ->first([
                'orderID as order_id',
                'orderStatus as status',
                'totalAmount as total',
                'orderDate as order_date',
                'addressID as address_id',
            ]);

        if (!$order) return ['error' => 'Order not found for your account.'];
        if ($order->status === 'cart') return ['error' => 'That is a cart (not checked out).'];

        $items = DB::table('order_items as oi')
            ->leftJoin('products as p', 'p.productID', '=', 'oi.productID')
            ->where('oi.orderID', $orderId)
            ->orderBy('oi.orderItemID')
            ->get([
                'oi.orderItemID as order_item_id',
                'oi.productID as product_id',
                'oi.quantity',
                'oi.priceAtTime as price_at_time',
                'p.productName  as product_name'
            ]);

        return ['order' => $order, 'items' => $items];
    }

    public function createSupportTicket(ChatConversation $conversation, ?Authenticatable $user, string $subject, string $summary): array
    {
        $ticket = SupportTicket::create([
            'userID' => $user?->getAuthIdentifier(),
            'guest_token' => $user ? null : $conversation->guest_token,
            'conversationID' => $conversation->conversationID,
            'status' => 'open',
            'subject' => $subject,
            'summary' => $summary,
        ]);

        return ['ticket_id' => $ticket->ticketID, 'status' => $ticket->status];
    }
}