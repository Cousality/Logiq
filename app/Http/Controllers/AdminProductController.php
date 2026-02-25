<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    private const CATEGORIES = ['Twist', 'Jigsaw', 'Word&Number', 'BoardGames', 'HandheldBrainTeasers'];
    private const DIFFICULTIES = ['easy', 'medium', 'hard'];
    private const STATUSES = ['active', 'hidden'];

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(20);
        return view('Frontend.dashboard.products.index', compact('products'));
    }

    public function create()
    {
        return view('Frontend.dashboard.products.create', [
            'categories'   => self::CATEGORIES,
            'difficulties' => self::DIFFICULTIES,
            'statuses'     => self::STATUSES,
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $validated = $request->validate([
            'productName'       => 'required|string|max:255',
            'productSlug'       => 'nullable|string|max:255',
            'productCategory'   => 'required|in:Twist,Jigsaw,Word&Number,BoardGames,HandheldBrainTeasers',
            'productDifficulty' => 'required|in:easy,medium,hard',
            'productPrice'      => 'required|numeric|min:0',
            'productDescription'=> 'nullable|string',
            'productImage'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'productQuantity'   => 'required|integer|min:0',
            'productStatus'     => 'required|in:active,hidden',
        ]);

        if ($request->hasFile('productImage')) {
            $path = $request->file('productImage')->store('products', 'public');
            $validated['productImage'] = $path;
        }

        $base = Str::slug($request->filled('productSlug') ? $request->productSlug : $request->productName);
        $slug = $base;
        $i = 1;
        while (Product::where('productSlug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $validated['productSlug'] = $slug;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('Frontend.dashboard.products.edit', [
            'product'      => $product,
            'categories'   => self::CATEGORIES,
            'difficulties' => self::DIFFICULTIES,
            'statuses'     => self::STATUSES,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $validated = $request->validate([
            'productName'       => 'required|string|max:255',
            'productSlug'       => 'nullable|string|max:255',
            'productCategory'   => 'required|in:Twist,Jigsaw,Word&Number,BoardGames,HandheldBrainTeasers',
            'productDifficulty' => 'required|in:easy,medium,hard',
            'productPrice'      => 'required|numeric|min:0',
            'productDescription'=> 'nullable|string',
            'productImage'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'productQuantity'   => 'required|integer|min:0',
            'productStatus'     => 'required|in:active,hidden',
        ]);

        if ($request->hasFile('productImage')) {
            if ($product->productImage) {
                Storage::disk('public')->delete($product->productImage);
            }
            $path = $request->file('productImage')->store('products', 'public');
            $validated['productImage'] = $path;
        } else {
            unset($validated['productImage']);
        }

        $base = Str::slug($request->filled('productSlug') ? $request->productSlug : $request->productName);
        $slug = $base;
        $i = 1;
        while (Product::where('productSlug', $slug)->where('productID', '!=', $product->productID)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $validated['productSlug'] = $slug;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        if ($product->productImage) {
            Storage::disk('public')->delete($product->productImage);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
