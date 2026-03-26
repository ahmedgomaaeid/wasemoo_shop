<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::withCount('products')->get();
        $latestProducts = Product::with('section')->where('is_latest', true)->latest()->take(8)->get();
        return view('home', compact('sections', 'latestProducts'));
    }

    public function section($slug)
    {
        $section = Section::where('slug', $slug)->firstOrFail();
        $products = $section->products()->latest()->paginate(12);
        return view('frontend.section', compact('section', 'products'));
    }
}
