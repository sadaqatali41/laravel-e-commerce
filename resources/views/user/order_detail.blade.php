@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Order Detail</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>                   
                        <li class="active">Order Detail</li>
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
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3>Details Address</h3>
                        {{$order->name}}({{$order->mobile}}) <br/>
                        {{$order->address}}<br/>{{$order->city}}</br>
                        {{$order->state}}</br/>
                        {{$order->pincode}}
                    </div>
                    <h5>
                        <a href="{{ route('user.orders') }}"><i>Go to Orders</i> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3>Order Details</h3>
                        Order ID : #{{ $order->id }}, <small style="font-weight: normal; font-style: italic;">Datetime : {{ $order->created_at }}</small><br/>
                        Order Status: 
                        @if($order->order_status == 1)
                            <span class="label label-warning">Placed</span>
                        @elseif ($order->order_status == 2)
                            <span class="label label-info">On the way</span>
                        @else
                            <span class="label label-success">Deliverd</span>
                        @endif
                        <br/>
                        Payment Status: 
                        @if($order->payment_status == 'PENDING')
                            <span class="label label-info">Pending</span>
                        @elseif ($order->payment_status == 'SUCCESS')
                            <span class="label label-success">Success</span>
                        @else
                            <span class="label label-danger">Failed</span>
                        @endif
                        <br/>
                        Payment Type: 
                        @if($order->payment_type == 'GT')
                            Online
                        @else
                            COD
                        @endif
                        <br/>
                        @if($order->txn_id !== null)
                            Payment ID: {{$order->txn_id}}
                        @endif                        
                    </div>
                    <h4>Trackings Details : </h4>
                    <dl style="margin-left: 1.5em;">
                        @foreach($order->trackings as $key => $tracking)
                            <dt>{{ $tracking->trackings }}</dt>
                            <dd style="margin-left: 1em; font-style: italic;"><i class="fa fa-clock-o"></i> {{ $tracking->created_at }}</dd>
                        @endforeach
                    </dl>
                </div>
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <div class="table-responsive">                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totAmt = 0;  @endphp
                                        @foreach ($order->orderDetails as $list)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.list', $list->product->slug) }}" target="_blank">{{ $list->product->prod_name }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/product/product_attr/' . $list->productAttribute->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/product/product_attr/' . $list->productAttribute->image) }}" alt="{{ $list->product->prod_name }}">
                                                    </a>
                                                </td>
                                                <td>{{ $list->productAttribute->size->size }}</td>
                                                <td>{{ $list->productAttribute->color->color }}</td>
                                                <td>{{ $list->price }}</td>
                                                <td>{{ $list->quantity }}</td>
                                                @php 
                                                $amount = $list->price * $list->quantity;
                                                $totAmt += $amount;
                                                @endphp
                                                <td>{{ $amount }}</td>
                                            </tr>  
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <td colspan="5"></td>
                                            <td><b>Total</b></td>
                                            <td><b>{{ $totAmt }}</b></td>
                                        </tr>
                                        @if($order->coupon_val > 0)
                                            <tr class="text-center">
                                                <td colspan="5"></td>
                                                <td><b>Coupon <small>({{ $order->coupon_cd }})</small></b></td>
                                                <td>-{{ $order->coupon_val }}</td>
                                            </tr>
                                            @php $finalTot = $totAmt - $order->coupon_val; @endphp
                                            <tr class="text-center">
                                                <td colspan="5"></td>
                                                <td><b>Final Total</b></td>
                                                <td>{{ $finalTot }}</td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                </table>
                            </div>                                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- / Cart view section -->
@endsection