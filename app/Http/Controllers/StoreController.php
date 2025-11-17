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

            if ($searchQuery) {
                $products = $this->fuzzySearch($searchQuery);
            } else {
                $products = Product::where('productStatus', 'active')
                    ->orderBy('productName')
                    ->get();
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
        $allProducts = Product::where('productStatus', 'active')->get();
        $results = [];
        $search = strtolower(trim($searchQuery));
        
        foreach ($allProducts as $product) {
            $score = 0;
            $name = strtolower($product->productName);
            $desc = strtolower($product->productDescription ?? '');
            
            // Check for matches
            if (str_contains($name, $search)) {
                $score += 100;
            }
            if (str_contains($desc, $search)) {
                $score += 50;
            }
            
            // Check similarity for typos
            $words = explode(' ', $name);
            foreach ($words as $word) {
                similar_text($search, $word, $percent);
                if ($percent > 70) {
                    $score += $percent;
                }
            }
            
            if ($score > 0) {
                $results[] = ['product' => $product, 'score' => $score];
            }
        }
        
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);
        
        return collect(array_map(fn($item) => $item['product'], $results));
    }
}
