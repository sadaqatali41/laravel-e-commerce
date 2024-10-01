<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


# Admin Routes
require_once __DIR__ . '/auth.php';

#front end route
Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.product');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.list');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');