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
        $promo = session('promo');
        $discount = 0;
        if ($promo) {
            $discount = $promo['type'] === 'percentage'
                ? $subtotal * ($promo['value'] / 100)
                : min($promo['value'], $subtotal);
            $discount = round($discount, 2);
        }
        $total = $subtotal - $discount + $shipping;

        $cartItems = $basketItems;

        return view('Frontend.checkout', compact('cartItems', 'subtotal', 'shipping', 'discount', 'promo', 'total'));
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
            'expiry' => 'required|string',
            'cvv' => 'required|string',
            'agree_terms' => 'accepted',
        ]);

        $user = auth()->user();

        $promo = session('promo');

        DB::transaction(function () use ($user, $promo) {
            $basket = Basket::with(['items.product'])
                ->where('userID', $user->userID)
                ->where('orderStatus', 'cart')
                ->lockForUpdate()
                ->firstOrFail();

            $items = $basket->items;

            if ($items->isEmpty()) {
                abort(400, 'Basket is empty');
            }

            foreach ($items as $item) {
                if ($item->product && $item->quantity > $item->product->productQuantity) {
                    abort(400, 'Not enough stock for ' . $item->product->productName . '. Only ' . $item->product->productQuantity . ' available.');
                }
            }

            $subtotal = $items->sum(function ($item) {
                return $item->product->productPrice * $item->quantity;
            });

            $discount = 0;
            if ($promo) {
                $discount = $promo['type'] === 'percentage'
                    ? $subtotal * ($promo['value'] / 100)
                    : min($promo['value'], $subtotal);
                $discount = round($discount, 2);
            }

            $shipping = 0;
            $total = $subtotal - $discount + $shipping;

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

        session()->forget('promo');

        return redirect()
            ->route('dashboard.orders')
            ->with('success', 'Dummy payment successful. Your order has been placed.');
    }
}
