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
            $categoryFilter = $request->input('category');

            if ($searchQuery) {
                $products = $this->fuzzySearch($searchQuery);
            } else {
                $products = Product::where('productStatus', 'active')
                    ->orderBy('productName')
                    ->get();
            }

            return view('Frontend.store', compact('products', 'searchQuery', 'categoryFilter'));
        } catch(Exception $e) {
            $products = [];
            $dbError = true;
            $searchQuery = $request->input('query');
            $categoryFilter = $request->input('category');

            return view('Frontend.store', compact('products', 'dbError', 'searchQuery', 'categoryFilter'));
        }
    }

    private function fuzzySearch($searchQuery)
    {
        $allProducts = Product::where('productStatus', 'active')->get();
        $results = [];
        $search = strtolower(trim($searchQuery));

        // Tweakable config
        $exactWeight   = 60;
        $fuzzyWeight   = 40;
        $similarityMin = 70;

        foreach ($allProducts as $product) {
            $score = 0;
            $name       = strtolower($product->productName);
            $desc       = strtolower($product->productDescription ?? '');
            $category   = strtolower($product->productCategory ?? '');
            $difficulty = strtolower($product->productDifficulty ?? '');

            // Exact substring matches
            if (str_contains($name, $search)) {
                $score += $exactWeight;
            }
            if ($desc && str_contains($desc, $search)) {
                $score += $exactWeight;
            }
            if ($category && str_contains($category, $search)) {
                $score += $exactWeight;
            }
            if ($difficulty && str_contains($difficulty, $search)) {
                $score += $exactWeight;
            }

            // Fuzzy matches
            $fieldsToCheck = [
                $name,
                $category,
                $difficulty,
            ];

            foreach ($fieldsToCheck as $field) {
                if (!$field) continue;

                // Option 1: whole field
                similar_text($search, $field, $percent);
                if ($percent >= $similarityMin) {
                    $score += $fuzzyWeight * ($percent / 100); // scale by similarity
                }

                // Option 2: word-by-word in the field
                $words = explode(' ', $field);
                foreach ($words as $word) {
                    similar_text($search, $word, $percentWord);
                    if ($percentWord >= $similarityMin) {
                        $score += $fuzzyWeight * ($percentWord / 100);
                    }
                }
            }

            if ($score > 0) {
                $results[] = ['product' => $product, 'score' => $score];
            }
        }

        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return collect(array_map(fn ($item) => $item['product'], $results));
    }
}
