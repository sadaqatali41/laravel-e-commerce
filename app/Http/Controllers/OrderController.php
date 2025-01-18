<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order() 
    {
        $user_id = auth()->id();
        $orders = Order::where('user_id', $user_id)
                        ->latest()
                        ->get();
        return view('user.order')->with('orders', $orders);
    }

    public function orderDetail($id)
    {
        $user_id = auth()->id();
        $order = Order::with([
                            'orderDetails.product',
                            'orderDetails.productAttribute.color',
                            'orderDetails.productAttribute.size',
                        ])
                        ->where([
                            'id' => $id,
                            'user_id' => $user_id
                        ])
                        ->first();
        if($order === null) {
            abort(500, 'Order detail is not found.');
        }
        return view('user.order_detail')->with('order', $order);
    }
}
