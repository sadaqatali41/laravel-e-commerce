<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
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
        Route::resources([
            'category' => CategoryController::class
        ]);
    });
});
