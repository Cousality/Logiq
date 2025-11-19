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

        return view('Frontend.your_orders', compact('orders'));
    }
}
