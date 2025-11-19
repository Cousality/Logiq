<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            return view('Frontend.product');
        } catch(Exception $e) {
            return view('Frontend.product');
        }
    }
}
