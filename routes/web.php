<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


# admin routes
require_once __DIR__ . '/auth.php';

# front end route
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}/{subcategory?}', [HomeController::class, 'category'])->name('category.product');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.list');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/search', [HomeController::class, 'search']);

# cart routes
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('/my-cart', [CartController::class, 'index'])->name('cart');
Route::post('/delete', [CartController::class, 'delete'])->name('cart.delete');

# user routes
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::get('/registration', [UserController::class, 'registration'])->name('registration');
        Route::post('/submit', [UserController::class, 'submit'])->name('submit');
        Route::post('/check', [UserController::class, 'check'])->name('check');
    });
});