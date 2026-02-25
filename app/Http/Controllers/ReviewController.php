<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function myPuzzles()
    {
        $reviews = Review::with('product')
            ->where('userID', Auth::id())
            ->latest()
            ->get();

        return view('Frontend.dashboard.my_puzzles', compact('reviews'));
    }

    public function deleteReview(Review $review)
    {
        if ($review->userID !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return redirect()->route('my_puzzles')->with('success', 'Your review has been deleted.');
    }

    public function updateReview(Request $request, Review $review)
    {
        if ($review->userID !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating'        => 'required|numeric|min:0.5|max:5',
            'reviewComment' => 'nullable|string|max:1000',
        ]);

        $rating = round($request->rating * 2) / 2;
        $rating = max(0.5, min(5.0, $rating));

        $review->rating        = $rating;
        $review->reviewComment = $request->reviewComment;
        $review->save();

        return redirect()->route('my_puzzles')->with('success', 'Your review has been updated successfully.');
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
