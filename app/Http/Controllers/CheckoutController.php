<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Later you'll load basket, addresses, etc. For now just show a placeholder.
        return view('Frontend.checkout');
    }
}
