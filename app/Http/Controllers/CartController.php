<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
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

        // Fetch Product Attribute ID
        $pa_id = ProductAttribute::select('id', 'qty')
                                ->where('product_id', '=', $product_id)
                                ->where('size_id', '=', $size_id)
                                ->where('color_id', '=', $color_id)
                                ->first();

        // Fetch Successfully ordered quantity for above product_attributes_id(pa_id)
        $orderedQuantity = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
                                        ->where('order_details.product_attribute_id', '=', $pa_id->id)
                                        ->where('order_details.product_id', '=', $product_id)
                                        ->sum('order_details.quantity');
        // Calculate remaining stock
        $remainingStock = $pa_id->qty - $orderedQuantity;
        if($quantity > $remainingStock) {
            return response()->json([
                'message'   => "Stock is not available"
            ], 200);
        }

        if(auth()->check()) {
            $user_id = auth()->user()->id;
            Cart::updateOrCreate([
                'user_id' => $user_id,
                'product_attribute_id' => $pa_id->id
            ], [
                'quantity' => $quantity
            ]);
        } else {
            Cart::updateOrCreate([
                'session_id' => $session_id,
                'product_attribute_id' => $pa_id->id
            ], [
                'quantity' => $quantity
            ]);
        }
        /* find cart items */ 
        $carts = myCart();
        $cartString = view('cart-string', $carts)->render();

        return response()->json([
            'message'   => 'Product added to cart successfully',
            'cartItems' => $cartString
        ], 200);
    }

    public function delete(Request $request) {
        $cart_id = $request->cart_id;
        Cart::find($cart_id)->delete();

        /* find cart items */ 
        $carts = myCart();
        $cartString = view('cart-string', $carts)->render();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Item Deleted Successfully',
            'cartItems' => $cartString
        ], 200);
    }
}
