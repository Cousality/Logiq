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

        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('productQuantity', $item->quantity);
            }
        }

        return back()->with('success', 'Your order has been cancelled.');
    }

    /* Return an order */
    public function returnOrder(Request $request, Order $order)
    {
        if ($order->userID !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->orderStatus, ['shipped', 'delivered'])) {
            return back()->with('error', 'This order cannot be returned.');
        }

        $order->orderStatus = 'returned';
        $order->save();

        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('productQuantity', $item->quantity);
            }
        }

        return back()->with('success', 'Your order has been returned.');
    }

    /* Delete a cancelled order */
    public function destroy(Order $order)
    {
        if ($order->userID !== Auth::id()) {
            abort(403);
        }

        if ($order->orderStatus !== 'cancelled') {
            return back()->with('error', 'Only cancelled orders can be deleted.');
        }

        $order->orderItems()->delete();
        $order->delete();

        return back()->with('success', 'Your order has been deleted.');
    }
}
