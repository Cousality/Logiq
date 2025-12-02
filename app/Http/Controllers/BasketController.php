<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    // sends user to login if not signed in
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show basket page.
     */
    public function index()
    {
        $user = auth()->user();

        $basket = Basket::with(['items.product'])
            ->where('userID', $user->userID)
            ->where('orderStatus', 'cart')
            ->first();

        $basketItems = $basket ? $basket->items : collect();

        return view('Frontend.basket', compact('basketItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'productID' => 'required|integer|exists:products,productID',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = auth()->user();
        $quantity = $request->input('quantity', 1);

        $basket = Basket::firstOrCreate(
            [
                'userID' => $user->userID,
                'orderStatus' => 'cart',
            ],
            [
                'totalAmount' => 0,
            ]
        );

        $product = Product::findOrFail($request->productID);

        $item = BasketItem::firstOrNew([
            'orderID' => $basket->orderID,
            'productID' => $product->productID,
        ]);

        $item->quantity = ($item->exists ? $item->quantity : 0) + $quantity;
        $item->priceAtTime = $product->productPrice;
        $item->save();

        return redirect()->route('store.index');
    }

    public function update(Request $request, BasketItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->quantity = $request->quantity;
        $item->save();

        return redirect()
            ->route('basket.index')
            ->with('success', 'Basket updated.');
    }

    public function remove(BasketItem $item)
    {
        $item->delete();

        return redirect()
            ->route('basket.index')
            ->with('success', 'Item removed from basket.');
    }
}
