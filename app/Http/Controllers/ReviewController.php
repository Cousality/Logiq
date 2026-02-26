<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviewModeration()
    {
        $reviews = Review::with(['product', 'user'])->latest()->get();

        return view('Frontend.dashboard.review_moderation', compact('reviews'));
    }

    public function adminDeleteReview(Review $review)
    {
        $review->delete();

        return redirect()->route('review_moderation')->with('success', 'Review deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'productID' => 'required|integer|exists:products,productID',
            'rating'    => 'required|numeric|min:0.5|max:5.0',
            'reviewComment' => 'nullable|string|max:1000',
        ]);

        // Round to nearest 0.5
        $rating = round($request->rating * 2) / 2;
        $rating = max(0.5, min(5.0, $rating));

        Review::updateOrCreate(
            [
                'userID'    => Auth::id(),
                'productID' => $request->productID,
            ],
            [
                'rating'        => $rating,
                'reviewComment' => $request->reviewComment,
            ]
        );

        $product = Product::findOrFail($request->productID);
        $avgRating = $product->reviews()->avg('rating');
        $reviewCount = $product->reviews()->count();

        return response()->json([
            'success'     => true,
            'avgRating'   => round($avgRating * 2) / 2,
            'reviewCount' => $reviewCount,
        ]);
    }
}
