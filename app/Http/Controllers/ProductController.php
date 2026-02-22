<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request, $productSlug)
    {
        $productID = $request->query('id');

        if ($productID) {
            $product = Product::where('productID', $productID)->firstOrFail();
        } else {
            $product = Product::where('productSlug', $productSlug)->firstOrFail();
        }

        $reviews = Review::where('productID', $product->productID)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();

        $avgRating = $reviews->avg('rating');
        $avgRating = $avgRating ? round($avgRating * 2) / 2 : null;
        $reviewCount = $reviews->count();

        $userReview = Auth::check()
            ? $reviews->firstWhere('userID', Auth::id())
            : null;

        return view('Frontend.product', compact('product', 'reviews', 'avgRating', 'reviewCount', 'userReview'));
    }
}
