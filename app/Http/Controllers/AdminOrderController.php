<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private const STATUSES = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'];

    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product'])
            ->orderBy('orderDate', 'desc');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('orderStatus', $request->status);
        }

        $orders = $query->paginate(20);

        $totalOrders   = Order::count();
        $totalRevenue  = Order::whereNotIn('orderStatus', ['cancelled', 'cart', 'returned'])->sum('totalAmount');
        $pendingCount  = Order::where('orderStatus', 'pending')->count();

        return view('Frontend.dashboard.order_management', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'pendingCount'
        ));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'orderStatus' => 'required|in:' . implode(',', self::STATUSES),
        ]);

        $newStatus = $request->orderStatus;

        if ($order->orderStatus === $newStatus) {
            return back()->with('error', 'Order is already ' . $newStatus . '.');
        }

        $order->orderStatus = $newStatus;
        $order->save();

        return back()->with('success', 'Order #' . $order->orderID . ' updated to ' . ucfirst($newStatus) . '.');
    }
}
