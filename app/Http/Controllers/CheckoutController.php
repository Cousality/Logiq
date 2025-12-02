<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // TODO: replace with real basket data
        $cartItems = [];
        $subtotal  = 0;
        $shipping  = 0;
        $total     = $subtotal + $shipping;

        return view('Frontend.checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'address_line1'  => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'postcode'       => 'required|string|max:20',
            'country'        => 'required|string|max:50',
            'payment_method' => 'required|in:card,paypal',
            'card_name'      => 'required|string|max:255',
            'card_number'    => 'required|string',
            'expiry_month'   => 'required|string',
            'expiry_year'    => 'required|string',
            'cvv'            => 'required|string',
            'agree_terms'    => 'accepted',
        ]);

        // Dummy payment logic – always "success"
        // Need to create order, move basket items, update stock, clear basket.

        return redirect()
            ->route('dashboard.orders')
            ->with('success', 'Dummy payment successful. Your order has been placed.');
    }
}
