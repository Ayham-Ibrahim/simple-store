<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});




Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{cartItem}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{cartItem}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
