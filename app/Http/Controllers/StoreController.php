<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        try {
            DB::connection()->getPdo();
            $query = Product::where('productStatus', 'active');

            $products = $query->orderBy('productName')->get();

            return view('Frontend.store', compact('products'));
        } catch(Exception $e) {
            $products = [];
            $dbError = true;

            return view('Frontend.store', compact('products', 'dbError'));
        }
    }
}
