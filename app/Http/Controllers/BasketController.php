<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
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

        $product = Product::findOrFail($request->productID);

        $basket = Basket::firstOrCreate(
            [
                'userID' => $user->userID,
                'orderStatus' => 'cart',
            ],
            [
                'totalAmount' => 0,
            ]
        );

        $item = BasketItem::firstOrNew([
            'orderID' => $basket->orderID,
            'productID' => $product->productID,
        ]);

        $newQuantity = ($item->exists ? $item->quantity : 0) + $quantity;

        if ($newQuantity > $product->productQuantity) {
            return redirect()->route('store.index')
                ->with('error', 'Not enough stock available. Only ' . $product->productQuantity . ' left.');
        }

        $item->quantity = $newQuantity;
        $item->priceAtTime = $product->productPrice;
        $item->save();

        return redirect()->route('store.index');
    }

    public function update(Request $request, BasketItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($item->product && $request->quantity > $item->product->productQuantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock. Only ' . $item->product->productQuantity . ' available.',
            ], 422);
        }

        $item->quantity = $request->quantity;
        $item->save();

        $basket = Basket::where('userID', auth()->user()->userID)
            ->where('orderStatus', 'cart')
            ->first();

        $basketCount = $basket ? $basket->items()->sum('quantity') : 0;

        return response()->json([
            'success' => true,
            'basketCount' => $basketCount,
        ]);
    }

    public function remove(BasketItem $item)
    {
        $item->delete();

        return redirect()
            ->route('basket.index')
            ->with('success', 'Item removed from basket.');
    }
}
