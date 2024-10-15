@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>My Cart</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>                   
                        <li class="active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->
 
    <!-- Cart view section -->
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            @if($carts->count() > 0)
                                <form action="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = $subtotal = 0; @endphp
                                                @foreach($carts as $cart)
                                                    <tr>
                                                        <td>
                                                            <a class="remove" data-id="{{ $cart->id }}" href="javascript:void(0)"><fa class="fa fa-close"></fa></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('product.list', $cart->product->slug) }}">
                                                                <img src="{{ asset('storage/product/product_attr/' . $cart->attribute->image) }}" alt="img">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a class="aa-cart-title" href="{{ route('product.list', $cart->product->slug) }}">{{ $cart->product->prod_name }}</a>
                                                            <p style="margin: 0;">{{ 'Size : ' . $cart->size->size }}</p>
                                                            <p style="margin: 0;">{{ 'Color : ' . $cart->color->color }}</p>
                                                        </td>
                                                        <td>${{ $cart->attribute->price }}</td>
                                                        <td>
                                                            <input 
                                                            class="aa-cart-quantity" 
                                                            type="number" 
                                                            min="1"
                                                            value="{{ $cart->quantity }}"
                                                            data-p="{{ $cart->product->product_id }}"
                                                            data-c="{{ $cart->color->color_id }}"
                                                            data-s="{{ $cart->size->size_id }}"
                                                            data-prc="{{ $cart->attribute->price }}"
                                                            >
                                                        </td>
                                                        @php
                                                            $subtotal += $cart->attribute->price * $cart->quantity;
                                                            $total += $cart->attribute->price * $cart->quantity;
                                                        @endphp
                                                        <td class="total">${{ $cart->attribute->price * $cart->quantity }}</td>
                                                    </tr> 
                                                @endforeach                                           
                                                {{-- <tr>
                                                    <td colspan="6" class="aa-cart-view-bottom">
                                                        <div class="aa-cart-coupon">
                                                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                                                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                                                        </div>
                                                        <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            @else
                                <h1>No Item Found.</h1>
                            @endif
                            <!-- Cart Total view -->
                            @if($carts->count() > 0)
                                <div class="cart-view-total">
                                    <h4>Cart Totals</h4>
                                    <table class="aa-totals-table">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td id="subtotal">${{ $subtotal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td id="total">${{ $total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="#" class="aa-cart-view-btn">Proceed to Checkout</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- / Cart view section -->
@endsection