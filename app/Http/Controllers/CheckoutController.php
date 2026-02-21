<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $basket = Basket::with(['items.product'])
            ->where('userID', $user->userID)
            ->where('orderStatus', 'cart')
            ->first();

        $basketItems = $basket ? $basket->items : collect();

        $subtotal = $basketItems->sum(function ($item) {
            return $item->product->productPrice * $item->quantity;
        });

        $shipping = 0;
        $total = $subtotal + $shipping;

        $cartItems = $basketItems;

        return view('Frontend.checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:50',
            'payment_method' => 'required|in:card,paypal',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string',
            'expiry_month' => 'required|string',
            'expiry_year' => 'required|string',
            'cvv' => 'required|string',
            'agree_terms' => 'accepted',
        ]);

        $user = auth()->user();

        DB::transaction(function () use ($user) {
            $basket = Basket::with(['items.product'])
                ->where('userID', $user->userID)
                ->where('orderStatus', 'cart')
                ->lockForUpdate()
                ->firstOrFail();

            $items = $basket->items;

            if ($items->isEmpty()) {
                abort(400, 'Basket is empty');
            }

            $subtotal = $items->sum(function ($item) {
                return $item->product->productPrice * $item->quantity;
            });

            $shipping = 0;
            $total = $subtotal + $shipping;

            $basket->totalAmount = $total;
            $basket->orderStatus = 'pending';
            $basket->orderDate = now();
            $basket->save();

            foreach ($items as $item) {
                if ($item->product) {
                    $item->product->decrement('productQuantity', $item->quantity);
                }
            }
        });

        return redirect()
            ->route('dashboard.orders')
            ->with('success', 'Dummy payment successful. Your order has been placed.');
    }
}
