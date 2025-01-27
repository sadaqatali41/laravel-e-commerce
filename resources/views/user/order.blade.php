@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>My Orders</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>                   
                        <li class="active">Orders</li>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Payment Type</th>
                                            <th>Total Amount</th>
                                            <th>Payment ID</th>
                                            <th>Datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderTblBody">
                                        @include('user.order_tmp')
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-primary" id="loadMoreOrder">Load More Orders...</button>
                                </div>
                            </div>                                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- / Cart view section -->
@endsection