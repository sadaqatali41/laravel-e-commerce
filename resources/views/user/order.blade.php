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
                                    <tbody>
                                        @forelse ($orders as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user.order.detail', $item->id) }}">
                                                        {{ $item->id }}
                                                    </a>
                                                </td>                                                
                                                <td>
                                                    @if($item->order_status == 1)
                                                        <span class="label label-warning">Placed</span>
                                                    @elseif ($item->order_status == 2)
                                                        <span class="label label-info">On the way</span>
                                                    @else
                                                        <span class="label label-success">Deliverd</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->payment_status == 'PENDING')
                                                        <span class="label label-info">Pending</span>
                                                    @elseif ($item->payment_status == 'SUCCESS')
                                                        <span class="label label-success">Success</span>
                                                    @else
                                                        <span class="label label-danger">Failed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->payment_type == 'GT')
                                                        Online
                                                    @else
                                                        COD
                                                    @endif
                                                </td>
                                                <td>{{ $item->total_amt }}</td>
                                                <td>{{ $item->txn_id }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="7">Sorry! No Order found.</th>
                                            </tr>
                                        @endforelse
                                    </tbody>
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