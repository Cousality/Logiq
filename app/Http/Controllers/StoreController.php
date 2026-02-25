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
            $searchQuery = $request->input('query');
            $category = $request->input('category');

            if ($searchQuery) {
                $products = $this->fuzzySearch($searchQuery);
            } else {
                $query = Product::where('productStatus', 'active')
                    ->withAvg('reviews', 'rating')
                    ->withCount('reviews')
                    ->orderBy('productName');

                if ($category) {
                    $query->where('productCategory', $category);
                }

                $products = $query->get();
            }

            return view('Frontend.store', compact('products', 'searchQuery'));
        } catch(Exception $e) {
            $products = [];
            $dbError = true;
            $searchQuery = $request->input('query');

            return view('Frontend.store', compact('products', 'dbError', 'searchQuery'));
        }
    }

    private function fuzzySearch($searchQuery)
    {
        $allProducts = Product::where('productStatus', 'active')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();
        $results = [];
        $search     = strtolower(trim($searchQuery));
        $searchNorm = preg_replace('/[^a-z0-9 ]/', '', $search);
        $searchWords = array_filter(explode(' ', $searchNorm));

        foreach ($allProducts as $product) {
            $score = 0;
            $name     = strtolower($product->productName);
            $nameNorm = preg_replace('/[^a-z0-9 ]/', '', $name);
            $desc     = strtolower($product->productDescription ?? '');
            $descNorm = preg_replace('/[^a-z0-9 ]/', '', $desc);

            // Exact substring match (normalised)
            if (str_contains($nameNorm, $searchNorm)) {
                $score += 100;
            }
            if (str_contains($descNorm, $searchNorm)) {
                $score += 50;
            }

            // Per-word fuzzy: every search word vs every name word
            $nameWords = array_filter(explode(' ', $nameNorm));
            foreach ($searchWords as $sw) {
                $bestWord = 0;
                foreach ($nameWords as $nw) {
                    similar_text($sw, $nw, $pct);
                    $bestWord = max($bestWord, $pct);
                }
                if ($bestWord >= 70) {
                    $score += $bestWord;
                }
            }

            if ($score > 0) {
                $results[] = ['product' => $product, 'score' => $score];
            }
        }

        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return collect(array_map(fn ($item) => $item['product'], $results));
    }

    public function suggestions(Request $request)
    {
        $query = $request->input('query', '');

        if (strlen(trim($query)) < 1) {
            return response()->json([]);
        }

        $products = $this->fuzzySearch($query)->take(6);

        $suggestions = $products->map(fn ($p) => [
            'name'  => $p->productName,
            'slug'  => $p->productSlug,
            'image' => $p->productImage,
            'price' => number_format($p->productPrice, 2),
        ]);

        return response()->json($suggestions);
    }
}
