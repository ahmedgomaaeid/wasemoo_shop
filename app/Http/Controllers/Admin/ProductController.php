<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('section')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('admin.products.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'section_id' => 'required|exists:sections,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:8192',
            'product_link' => 'nullable|url|max:255',
        ]);

        $data = $request->except('image_path', 'is_latest');
        $data['slug'] = Str::slug($request->name);
        $data['is_latest'] = $request->has('is_latest');

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $sections = Section::all();
        return view('admin.products.edit', compact('product', 'sections'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'section_id' => 'required|exists:sections,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:8192',
            'product_link' => 'nullable|url|max:255',
        ]);

        $data = $request->except('image_path', 'is_latest');
        $data['slug'] = Str::slug($request->name);
        $data['is_latest'] = $request->has('is_latest');
        $data['product_link'] = $request->product_link;

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
