<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /* Display user's orders */
    public function index(Request $request)
    {
        try {
            DB::connection()->getPdo();
            
            $query = Order::where('userID', Auth::id())
                ->with(['orderItems.product'])
                ->orderBy('orderDate', 'desc');

            // Filter by status if provided
            if ($request->has('status') && $request->status != 'all') {
                $query->where('orderStatus', $request->status);
            }

            $orders = $query->get();

            return view('Frontend.your_orders', compact('orders'));
        } catch (Exception $e) {
            // Return empty orders array if database is unavailable
            $orders = collect([]);
            return view('Frontend.your_orders', compact('orders'));
        }
    }
}
