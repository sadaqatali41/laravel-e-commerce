<?php

use App\Models\Cart;
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