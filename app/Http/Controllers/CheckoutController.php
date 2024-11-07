<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
            $userId = auth()->id();
            $hasUsedCoupon = Order::where('user_id', $userId)
                                ->where('coupon_cd', $coupon_cd)
                                ->exists();

            if ($hasUsedCoupon) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'This Coupon has already been used.',
                ]);
            }
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

    public function processOrder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'apartment' => 'required',
            'coupon_cd' => 'nullable|exists:coupons,code'
        ], [
            'coupon_cd.exists' => 'Invalid Coupon Code',
        ]);

        try {
            DB::beginTransaction();

            $orderData = [
                'user_id' => auth()->user()->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'pincode' => $request->input('zip'),
                'address' => $request->input('address'),
                'apartment' => $request->input('apartment'),
                'coupon_cd' => Str::upper($request->input('coupon_cd')),
                'coupon_val' => 0,
                'payment_type' => $request->input('payment_type'),
                'payment_status' => 'PENDING',
                'payment_id' => null,
                'total_amt' => 0
            ];
    
            $order = Order::create($orderData);
            $order_id = $order->id;

            #commit the transaction
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Your Order is Successfully Placed'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
