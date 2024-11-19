<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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
        Route::get('/activate-account/{token}', [UserController::class, 'activateAccount'])->name('activate');
        Route::post('/password-reset-submit', [UserController::class, 'passwordResetSubmit'])->name('password.reset');
        Route::get('/password/reset/{token}', [UserController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('password.update');
    });

    Route::middleware(['auth:web'])->group(function(){
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/check-valid-coupon', [CheckoutController::class, 'checkValidCoupon'])->name('check.coupon');
        Route::post('/process-order', [CheckoutController::class, 'processOrder'])->name('process.order');
        Route::get('/thankyou', [CheckoutController::class, 'thankYou'])->name('thankyou');
        Route::get('paypal/success', [CheckoutController::class, 'success'])->name('paypal.success');
        Route::get('paypal/cancel', [CheckoutController::class, 'cancel'])->name('paypal.cancel');
        #user orders
        Route::get('orders', [OrderController::class, 'order'])->name('orders');
        Route::get('orders/{id}', [OrderController::class, 'orderDetail'])->name('order.detail');
    });
});