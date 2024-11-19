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
        $order = Order::where([
                            'id' => $id,
                            'user_id' => $user_id
                        ])
                        ->first();
        return view('user.order_detail')->with('order', $order);
    }
}
