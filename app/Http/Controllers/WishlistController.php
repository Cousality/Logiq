<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // sends user to login if not signed in
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* Add product to wishlist */
    public function add(Request $request)
    {
        $request->validate([
            'productID' => 'required|integer|exists:products,productID',
        ]);

        Wishlist::create([
            'userID' => Auth::id(),
            'productID' => $request->productID,
        ]);

        return response()->json(['success' => true]);
    }

    /* Remove product from wishlist */
    public function remove(Request $request)
    {
        $request->validate([
            'productID' => 'required|integer|exists:products,productID',
        ]);

        Wishlist::where('userID', Auth::id())
            ->where('productID', $request->productID)
            ->delete();

        return response()->json(['success' => true]);
    }

    /* Display wishlist */
    public function index()
    {
        $wishlistItems = Wishlist::where('userID', Auth::id())->with('product')->get();

        return view('Frontend.wishlist', compact('wishlistItems'));
    }
}
