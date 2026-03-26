<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('section')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('section_id', $product->section_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4)
                                  ->get();
                                  
        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
