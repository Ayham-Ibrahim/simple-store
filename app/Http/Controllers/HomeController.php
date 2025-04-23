<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Eager load products to avoid N+1 problem
        // Limit products per category for the home page if needed
        $categoriesWithProducts = Category::with(['products' => function ($query) {
            $query->limit(100); // Example: Show max 8 products per category on home
        }])->get();

        return view('home', compact('categoriesWithProducts'));
    }
}
