<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Instamojo\Instamojo;
use App\Models\OrderDetail;
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
        if($cart['cartCount'] == 0) {
            return redirect()->route('cart');
        }
        return view('checkout', $cart);
    }

    public function checkValidCoupon(Request $request)
    {
        $coupon_cd = $request->coupon_cd;
        $orderVal = $request->orderVal;
        
        $result = validateCoupon($coupon_cd, $orderVal);

        return response()->json($result, 200);
    }

    public function processOrder(Request $request)
    {
        $payment_url = '';

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

        #fetch my cart
        $cart = myCart();
        $orderVal = $cart['totalPrice'];
        $couponVal = 0;
        $coupon_cd = null;
        if($request->input('coupon_cd') != '') {
            $coupon_cd = Str::upper($request->input('coupon_cd'));
            $result = validateCoupon($coupon_cd, $orderVal);
            if($result['status'] == 'success') {
                $couponVal = $result['couponVal'];
            } else {
                return response()->json($result, 200);
            }
        }

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
                'coupon_cd' => $coupon_cd,
                'coupon_val' => $couponVal,
                'payment_type' => $request->input('payment_type'),
                'payment_status' => 'PENDING',
                'payment_id' => null,
                'total_amt' => $orderVal
            ];
    
            $order = Order::create($orderData);
            $order_id = $order->id;

            foreach($cart['carts'] as $key => $singleCart) {
                $orderDetails = [
                    'order_id' => $order_id,
                    'product_id' => $singleCart->product->product_id,
                    'product_attribute_id' => $singleCart->product_attribute_id,
                    'price' => $singleCart->attribute->price,
                    'quantity' => $singleCart->quantity
                ];
                OrderDetail::create($orderDetails);
            }

            #payment gateway handling
            if($request->payment_type === 'GT') {
                $api = new Instamojo(
                    config('services.instamojo.api_key'),
                    config('services.instamojo.auth_token'),
                    config('services.instamojo.endpoint')
                );
                $actualAmount = $orderVal - $couponVal;

                $data = [
                    'purpose' => 'E-commerce Payment',
                    'amount' => $actualAmount,
                    'buyer_name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'redirect_url' => route('user.gateway.redirect'),
                ];
                $response = $api->paymentRequestCreate($data);
                print_r($response);die;
            }

            #delete cart items
            $userId = auth()->id();
            // Cart::where('user_id', '=', $userId)->delete();

            #commit the transaction
            DB::commit();

            session()->flash('message', 'Your Order is Successfully Placed with Order ID : ' . $order_id);

            return response()->json([
                'status' => 'success',
                'payment_url' => $payment_url,
                'url' => route('user.thankyou')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'payment_url' => $payment_url,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function thankYou() {
        if(session()->has('message')) {
            return view('thankyou');
        } else {
            return redirect()->route('cart');
        }
    }

    public function gatewayRedirect(Request $request) {
        print_r($_GET);
    }
}
