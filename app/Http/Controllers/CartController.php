<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin\ProductAttribute;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $carts = myCart();
        return view('my-cart', $carts);
    }

    public function addToCart(Request $request) {
        $product_id = $request->product_id;
        $color_id = $request->color_id;
        $size_id = $request->size_id;
        $quantity = $request->quantity;
        $session_id = Session::getId();

        $pa_id = ProductAttribute::select('id')
                                ->where('product_id', '=', $product_id)
                                ->where('size_id', '=', $size_id)
                                ->where('color_id', '=', $color_id)
                                ->first();
        if(auth()->check()) {
            $user_id = auth()->user()->id;
            Cart::updateOrCreate([
                'user_id' => $user_id,
                'product_attribute_id' => $pa_id->id
            ], [
                'quantity' => $quantity
            ]);
            $totalCartItems = Cart::where('user_id', $user_id)->count();
        } else {
            Cart::updateOrCreate([
                'session_id' => $session_id,
                'product_attribute_id' => $pa_id->id
            ], [
                'quantity' => $quantity
            ]);
            $totalCartItems = Cart::where('session_id', $session_id)->count();
        }
        return response()->json([
            'message'   => 'Product added to cart successfully',
            'totItms'   => $totalCartItems
        ], 200);
    }

    public function delete(Request $request) {
        $cart_id = $request->cart_id;
        Cart::find($cart_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item Deleted Successfully'
        ], 200);
    }
}
