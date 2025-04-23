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

    /**
     * Search for products, potentially within a specific category context.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryContextName = $request->input('category_context'); // Get the category name if provided

        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.'); // Redirect back is often better
        }

        // Start building the query
        $productsQuery = Product::query();

        // --- Apply Category Context Filter ---
        if ($categoryContextName) {
            // If a category context is provided, filter products belonging to that category
            // Assumes a 'categories' relationship exists on the Product model
            // And the Category model has a 'name' column
            $productsQuery->whereHas('category', function ($q) use ($categoryContextName) {
                $q->where('name', $categoryContextName);
            });
        }
        // --- No else needed: if no category context, search all products ---


        // --- Apply Search Term Filter ---
        // Search in product name AND description (more useful than price usually)
        $productsQuery->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%"); // Added description search
        });

        // --- Fetch and Paginate Results ---
        $products = $productsQuery->paginate(100);

        // Append query parameters to pagination links
        $products->appends($request->except('page'));

        // Pass data to the search results view
        return view('products.search-results', compact('products', 'query', 'categoryContextName'));
    }
}
