<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /* Display user's orders */
    public function index(Request $request)
    {
        $query = Order::where('userID', Auth::id())
            ->with(['orderItems.product'])
            ->orderBy('orderDate', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('orderStatus', $request->status);
        }

        $orders = $query->get();

        return view('Frontend.dashboard.your_orders', compact('orders'));
    }

    /* Cancel an order */
    public function cancel(Request $request, Order $order)
    {
        // Ensure order belongs to the authenticated user
        if ($order->userID !== Auth::id()) {
            abort(403);
        }

        // Only pending or processing orders can be cancelled
        if (!in_array($order->orderStatus, ['pending', 'processing'])) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $order->orderStatus = 'cancelled';
        $order->save();

        return back()->with('success', 'Your order has been cancelled.');
    }
}
