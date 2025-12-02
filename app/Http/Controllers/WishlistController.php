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

        // Checking that product isn't in the wishlist
        $exists = Wishlist::where('userID', Auth::id())
            ->where('productID', $request->productID)
            ->exists();

        if ($exists) {
            return redirect()->route('store.index')->with('info', 'Product is already in your wishlist.');
        }

        Wishlist::create([
            'userID' => Auth::id(),
            'productID' => $request->productID,
        ]);

        return redirect()->route('store.index')->with('success', 'Product added to wishlist.');
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
