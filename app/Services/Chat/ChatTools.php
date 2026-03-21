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
        if ($order->status === 'cart') return ['error' => 'This is in your cart (not checked out).'];

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

    public function getProductStockById(int $productId): array
    {
        $p = DB::table('products')
            ->where('productID', $productId)
            ->first(['productID', 'productName', 'productQuantity', 'productStatus']);

        if (!$p) return ['error' => 'Product not found'];

        $qty = (int)$p->productQuantity;
        $active = ((string)$p->productStatus === 'active');

        $status = (!$active || $qty <= 0) ? 'out_of_stock'
            : ($qty <= 3 ? 'low_stock' : 'in_stock');

        return [
            'product_id' => (int)$p->productID,
            'product_name' => (string)$p->productName,
            'stock_status' => $status,
            'stock_qty' => max(0, $qty),
        ];
    }

    public function searchProductStock(string $query): array
    {
        $q = trim($query);
        if ($q === '') return ['matches' => []];

        $rows = DB::table('products')
            ->where('productStatus', 'active')
            ->where('productName', 'like', '%' . $q . '%')
            ->orderByDesc('productQuantity')
            ->limit(5)
            ->get(['productID', 'productName', 'productQuantity']);

        // Return in a consistent format
        $matches = $rows->map(function ($p) {
            $qty = (int)$p->productQuantity;
            $status = ($qty <= 0) ? 'out_of_stock' : ($qty <= 3 ? 'low_stock' : 'in_stock');

            return [
                'product_id' => (int)$p->productID,
                'product_name' => (string)$p->productName,
                'stock_status' => $status,
                'stock_qty' => max(0, $qty),
            ];
        });

        return ['matches' => $matches];
    }

    public function createSupportTicket(ChatConversation $conversation, 
    ?Authenticatable $user, 
    string $problemCategory, 
    string $problemDescription, 
    ?string $orderNumber = null,
    ?string $name = null,
    ?string $email = null): array {
    $category = $this->normaliseCategory($problemCategory);

    if ($user) {
            $userID = (int)$user->getAuthIdentifier();

            $u = DB::table('users')
                ->where('userID', $userID)
                ->first(['firstName', 'lastName', 'email']);

            $fullName = $u ? trim(($u->firstName ?? '') . ' ' . ($u->lastName ?? '')) : null;
            $userEmail = $u?->email ?? null;

            // Fallbacks (should not be needed in normal use)
            $name = $fullName ?: ('User #' . $userID);
            $email = $userEmail ?: 'unknown@example.com';

            $supportNum = DB::table('contact')->insertGetId([
                'userID' => $userID,
                'name' => $this->limitLen($name, 50),
                'email' => $this->limitLen($email, 50),
                'orderNumber' => $orderNumber ? $this->limitLen($orderNumber, 50) : null,
                'problemCategory' => $category,
                'problemDescription' => $problemDescription,
                'created_at' => now(),
                'updated_at' => now(),
            ], 'supportNum');

            return [
                'ticket_number' => (int)$supportNum,
                'problem_category' => $category,
                'saved_to' => 'contact',
            ];
        }

        // Guest path: must have name + email (columns are NOT NULL)
        $name = trim((string)$name);
        $email = trim((string)$email);

        if ($name === '' || $email === '') {
            return [
                'error' => 'missing_guest_identity',
                'message' => 'Guest tickets require name and email.',
                'required' => ['name', 'email'],
            ];
        }

        $supportNum = DB::table('contact')->insertGetId([
            'userID' => 0,
            'name' => $this->limitLen($name, 50),
            'email' => $this->limitLen($email, 50),
            'orderNumber' => $orderNumber ? $this->limitLen($orderNumber, 50) : null,
            'problemCategory' => $category,
            'problemDescription' => $problemDescription,
            'created_at' => now(),
            'updated_at' => now(),
        ], 'supportNum');

        return [
            'ticket_number' => (int)$supportNum,
            'problem_category' => $category,
            'saved_to' => 'contact',
        ];
    }

    private function normaliseCategory(string $cat): string
    {
        $c = strtolower(trim($cat));
        return match ($c) {
            'delivery' => 'Delivery',
            'refund' => 'Refund',
            'account' => 'Account',
            'payment' => 'Payment',
            'other' => 'Other',
            default => 'Other',
        };
    }

    private function limitLen(string $s, int $max): string
    {
        return mb_substr($s, 0, $max);
        }
}