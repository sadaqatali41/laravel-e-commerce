<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Admin\Coupon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

function myCart() {
    
    $seconds = Config::get('constants.CACHE_EXP');
    $session_id = Session::getId();
    if(auth()->check()) {
        $user_id = auth()->user()->id;
        $column_nm = 'user_id';
        $column_val = $user_id;
    } else {
        $column_nm = 'session_id';
        $column_val = $session_id;
    }
    $itemCount = Cart::where($column_nm, '=', $column_val)->sum('quantity');

    $carts = Cache::remember('my-carts-' . $itemCount, $seconds, function() use ($column_nm, $column_val) {
        return Cart::where($column_nm, '=', $column_val)
                    ->with([
                        'attribute',
                        'product' => function($query) {
                            $query->select('products.id as product_id', 'prod_name', 'slug');
                        },
                        'color' => function($query) {
                            $query->select('colors.id as color_id', 'color');
                        },
                        'size' => function($query) {
                            $query->select('sizes.id as size_id', 'size');
                        }
                    ])
                    ->get();
    });
    $cartCount = $carts->count();
    $totalPrice = $carts->sum(function($item){
        return $item->attribute->price * $item->quantity;
    });
    return compact('carts', 'cartCount', 'totalPrice');
}

function validateCoupon($coupon_cd, $orderVal) {

    $result = Coupon::where('code', '=', $coupon_cd)
                        ->where('status', '=', 'A')
                        ->first();

    #check if coupon exists
    if(is_null($result)) {
        return [
            'status' => 'error',
            'error' => 'Invalid Coupon Code'
        ];
    }

    #check minimum order requirement
    if($result->min_order > $orderVal) {
        return [
            'status' => 'error',
            'error' => 'This Coupon is not valid for Subtotal ' . $orderVal
        ];
    }

    #check if the coupon is one-time to use
    if($result->is_one_time) {
        #check from order table for logged-in user
        $userId = auth()->id();
        $hasUsedCoupon = Order::where('user_id', $userId)
                            ->where('coupon_cd', $coupon_cd)
                            ->exists();

        if ($hasUsedCoupon) {
            return [
                'status' => 'error',
                'error' => 'This Coupon has already been used.',
            ];
        }
    }

    #apply the coupon based on type
    $newOrderVal = $orderVal;
    if ($result->type === 'P') {
        $couponVal = $orderVal * ($result->value * 0.01);
        $newOrderVal = $orderVal - $couponVal;
    } elseif ($result->type === 'V') {
        $couponVal = $result->value;
        $newOrderVal = max(0, $orderVal - $couponVal);
    }

    return [
        'status' => 'success',
        'message' => 'Coupon Code is applied',
        'orderVal' => round($newOrderVal),
        'couponVal' => round($couponVal)
    ];
}