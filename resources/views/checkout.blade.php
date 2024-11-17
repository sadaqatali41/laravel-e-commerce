@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Checkout Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>                   
                        <li class="active">Checkout</li>
                    </ol>
                </div>
            </div>
       </div>
    </section>
    <!-- / catg header banner section -->
    <!-- Cart view section -->
    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-area">
                        <form action="{{ route('user.process.order') }}" id="orderForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="checkout-left">
                                        <div class="panel-group" id="accordion">                                            
                                            <!-- Shipping Address -->
                                            <div class="panel panel-default aa-checkout-billaddress">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                            Shippping Address
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="Name*" value="{{ auth()->user()->name }}" name="name" id="name">
                                                                </div>                             
                                                            </div>  
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="email" placeholder="Email*" value="{{ auth()->user()->email }}" name="email" id="email" readonly>
                                                                </div>                             
                                                            </div>                                                          
                                                        </div>                                                          
                                                        <div class="row">                                                            
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="tel" placeholder="Phone*" value="{{ auth()->user()->mobile }}" name="mobile" id="mobile" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="City / Town*" value="{{ auth()->user()->city }}" name="city" id="city">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="State*" value="{{ auth()->user()->state }}" name="state" id="state">
                                                                </div>                             
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="Postcode / ZIP*" value="{{ auth()->user()->zip }}" name="zip" id="zip">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="aa-checkout-single-bill">
                                                                    <textarea cols="8" rows="3" name="address" id="address" placeholder="Address">{{ auth()->user()->address }}</textarea>
                                                                </div>                             
                                                            </div>                            
                                                        </div>                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="Appartment, Suite etc." name="apartment" id="apartment">
                                                                </div>                             
                                                            </div>                                                            
                                                        </div>                                                                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkout-right">
                                        <h4>Order Summary</h4>
                                        <div class="aa-order-summary-area">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($carts as $cart)
                                                        <tr>
                                                            <td>{{ $cart->product->prod_name }} 
                                                                <strong> x  {{ $cart->quantity }}</strong>
                                                                <br>
                                                                <span style="font-size: 12px; font-weight: bold; color: green;"> {{ $cart->color->color }} - {{ $cart->size->size }} </span>
                                                            </td>
                                                            <td>${{ $cart->attribute->price * $cart->quantity }}</td>
                                                        </tr>   
                                                    @endforeach                                             
                                                </tbody>
                                                <tfoot>
                                                    <tr class="coupon_cd_row hidden"></tr>
                                                    <tr>
                                                        <th>Subtotal</th>
                                                        <th id="totalPrice">${{ $totalPrice }}</th>
                                                    </tr>                                                    
                                                </tfoot>
                                            </table>
                                        </div>
                                        <h4>Have a Coupon</h4>
                                        <div class="aa-checkout-coupon">
                                            <input type="text" placeholder="Coupon Code" class="aa-coupon-code" name="coupon_cd" id="coupon_cd">
                                            <input type="button" 
                                            value="Apply Coupon" 
                                            class="aa-browse-btn" 
                                            id="applyCoupon" 
                                            data-val="{{ $totalPrice }}" 
                                            data-url="{{ route('user.check.coupon') }}"
                                            style="padding: 8px 13px; width: -webkit-fill-available;">
                                        </div>
                                        <div id="coupon_error"></div>
                                        <br>
                                        <h4>Payment Method</h4>
                                        <div class="aa-payment-method">                    
                                            <label for="cashdelivery">
                                                <input type="radio" id="cashdelivery" name="payment_type" value="COD" checked> Cash on Delivery 
                                            </label>
                                            <label for="paypal">
                                                <input type="radio" id="paypal" name="payment_type" value="GT"> Paypal 
                                            </label>                                            
                                            <input type="submit" value="Place Order" class="aa-browse-btn" id="orderFormBtn">                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </section>
    <!-- / Cart view section -->
@endsection
