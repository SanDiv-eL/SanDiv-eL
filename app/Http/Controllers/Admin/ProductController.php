<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = \App\Models\Category::all();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|url',
            'spec_keys' => 'nullable|array',
            'spec_values' => 'nullable|array',
        ]);

        $data = $request->except(['spec_keys', 'spec_values']);
        $data['slug'] = \Illuminate\Support\Str::slug($request->name);

        // Build specifications from key-value pairs
        if ($request->has('spec_keys') && $request->has('spec_values')) {
            $specifications = [];
            foreach ($request->spec_keys as $index => $key) {
                if (!empty($key) && !empty($request->spec_values[$index])) {
                    $specifications[$key] = $request->spec_values[$index];
                }
            }
            $data['specifications'] = $specifications;
        }

        \App\Models\Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|url',
            'spec_keys' => 'nullable|array',
            'spec_values' => 'nullable|array',
        ]);

        $product = \App\Models\Product::findOrFail($id);
        $data = $request->except(['spec_keys', 'spec_values']);
        
        if($product->name !== $request->name) {
             $data['slug'] = \Illuminate\Support\Str::slug($request->name);
        }

        // Build specifications from key-value pairs
        if ($request->has('spec_keys') && $request->has('spec_values')) {
            $specifications = [];
            foreach ($request->spec_keys as $index => $key) {
                if (!empty($key) && !empty($request->spec_values[$index])) {
                    $specifications[$key] = $request->spec_values[$index];
                }
            }
            $data['specifications'] = $specifications;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
