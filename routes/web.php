<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Select2Controller;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

# Admin Routes
Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin'])->group(function(){
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/category-list', [Select2Controller::class, 'category'])->name('category-list');
        Route::resources([
            'category' => CategoryController::class,
            'subcategory' => SubCategoryController::class,
            'coupon' => CouponController::class,
            'size' => SizeController::class,
            'color' => ColorController::class
        ]);
    });
});
