<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('productStatus', 'active');
        
        $products = $query->orderBy('productName')->get();
        
        return view('Frontend.store', compact('products'));
    }
}