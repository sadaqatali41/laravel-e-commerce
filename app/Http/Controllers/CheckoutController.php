<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = myCart();
        return view('checkout', $cart);
    }

    public function checkValidCoupon(Request $request)
    {
        $coupon_cd = $request->coupon_cd;
        $orderVal = $request->orderVal;
        
        $result = Coupon::where('code', '=', $coupon_cd)
                            ->where('status', '=', 'A')
                            ->first();

        #check if coupon exists
        if(is_null($result)) {
            return response()->json([
                'status' => 'error',
                'error' => 'Invalid Coupon Code'
            ]);
        }

        #check minimum order requirement
        if($result->min_order > $orderVal) {
            return response()->json([
                'status' => 'error',
                'error' => 'This Coupon is not valid for Subtotal ' . $orderVal
            ]);
        }

        #check if the coupon is one-time use
        if($result->is_one_time) {
            #check from order table
        }

        #apply the coupon based on type
        $newOrderVal = $orderVal;
        if ($result->type === 'P') {
            $discountAmount = $orderVal * ($result->value * 0.01);
            $newOrderVal = $orderVal - $discountAmount;
        } elseif ($result->type === 'V') {
            $discountAmount = $result->value;
            $newOrderVal = max(0, $orderVal - $discountAmount);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon Code is applied',
            'orderVal' => round($newOrderVal),
            'discountAmount' => round($discountAmount)
        ], 200);
    }
}
