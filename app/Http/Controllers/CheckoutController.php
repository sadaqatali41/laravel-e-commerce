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
        if(is_null($result)) {
            return response()->json([
                'status' => 'error',
                'error' => 'Invalid Coupon Code'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Coupon Code is applied'
        ], 200);
    }
}
