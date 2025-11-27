<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $productSlug)
    {
        try {
            $productID = $request->query('id');

            if ($productID) {
                $product = Product::where('productID', $productID)->firstOrFail();
            } else {
                $product = Product::where('productSlug', $productSlug)->firstOrFail();
            }

            return view('Frontend.product', compact('product'));
        } catch(Exception $e) {
            return view('Frontend.product');
        }
    }
}
