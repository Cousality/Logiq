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

            // Handle search query
            $searchQuery = $request->input('query');
            if ($searchQuery) {
                $query->where(function($q) use ($searchQuery) {
                    $q->where('productName', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('productDescription', 'LIKE', "%{$searchQuery}%");
                });
            }

            $products = $query->orderBy('productName')->get();

            return view('Frontend.store', compact('products', 'searchQuery'));
        } catch(Exception $e) {
            $products = [];
            $dbError = true;
            $searchQuery = $request->input('query');

            return view('Frontend.store', compact('products', 'dbError', 'searchQuery'));
        }
    }
}
