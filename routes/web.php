<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


# admin routes
require_once __DIR__ . '/auth.php';

# front end route
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}/{subcategory?}', [HomeController::class, 'category'])->name('category.product');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.list');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');

# cart routes
Route::post('/add-to-cart', [CartController::class, 'addToCart']);