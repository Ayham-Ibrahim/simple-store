<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحة السلة
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// لوحة تحكم الأدمن
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});

// Auth routes (مع auth UI)
Auth::routes();

Route::get('/redirect-after-login', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('dashboard');
    }

    return redirect()->route('home');
})->middleware('auth')->name('redirect.after.login');

// Home Page - Display categories and some products
Route::get('/', [HomeController::class, 'index'])->name('home');

// Category Page - Display products by category slug
// Use route model binding with the 'slug' column
Route::get('/category/{category:name}', [CategoryController::class, 'showInHome'])->name('category.show');

// Search Results Page
Route::get('/search', [ProductController::class, 'search'])->name('search'); // Assuming search logic is in ProductController

// Cart Page (Example - create CartController later)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
