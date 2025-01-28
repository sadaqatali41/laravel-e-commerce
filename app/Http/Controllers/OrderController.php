<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request) 
    {
        $user_id = auth()->id();
        $orders = Order::where('user_id', $user_id)
                        ->latest()
                        ->paginate(10);
        if($request->ajax()) {
            $view = view('user.order_tmp', compact('orders'))->render();
            return response()->json(['html' => $view]);
        }
        return view('user.order')->with('orders', $orders);
    }

    public function orderDetail($id)
    {
        $user_id = auth()->id();
        $order = Order::with([
                            'orderDetails.product',
                            'orderDetails.productAttribute.color',
                            'orderDetails.productAttribute.size',
                            'trackings' => function($q) {
                                return $q->oldest();
                            }
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
