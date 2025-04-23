<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'تمت إضافة المنتج بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            // Redirect back or show an error/empty page if query is empty
            return redirect()->route('home')->with('error', 'Please enter a search term.');
        }

        // Simple search in name and description
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('price', 'LIKE', "%{$query}%") // Optional: search description too
            ->paginate(16); // Paginate results

        // Pass the query back to the view if needed for display
        return view('products.search-results', compact('products', 'query'));
    }
}
