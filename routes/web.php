<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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