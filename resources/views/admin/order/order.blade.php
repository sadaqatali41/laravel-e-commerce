@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.coupon.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.coupon.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tite" class=" form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Title.." class="form-control form-control-sm" value="{{ old('title') }}">
                                            @error('title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="code" class=" form-control-label">Code</label>
                                            <input type="text" id="code" name="code" placeholder="Code.." class="form-control form-control-sm" value="{{ old('code') }}">
                                            @error('code')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="value" class=" form-control-label">Value</label>
                                            <input type="text" id="value" name="value" placeholder="Value.." class="form-control form-control-sm" value="{{ old('value') }}">
                                            @error('value')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="type" class=" form-control-label">Type</label>
                                            <select name="type" id="type" class="form-control form-control-sm">
                                                <option value="P" @if(old('type') === 'P') selected @endif>Percent</option>
                                                <option value="V" @if(old('type') === 'V') selected @endif>Value</option>
                                            </select>
                                            @error('type')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="min_order" class=" form-control-label">Min Order</label>
                                            <input type="text" id="min_order" name="min_order" placeholder="Min Order.." class="form-control form-control-sm" value="{{ old('min_order') }}">
                                            @error('min_order')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="is_one_time" class=" form-control-label">One Time ?</label>
                                            <select name="is_one_time" id="is_one_time" class="form-control form-control-sm">
                                                <option value="1" @if(old('is_one_time') === '1') selected @endif>Yes</option>
                                                <option value="0" @if(old('is_one_time') === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_one_time')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status') === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status') === 'I') selected @endif>Inactive</option>
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                </div>                        
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @break
        @case('edit')
            <div class="row">
                <div class="col-md-6">
                    <div class="order_detail">
                        <h4>Details Address</h4>
                        {{$order->name}}({{$order->mobile}}) <br/>
                        {{$order->address}}<br/>{{$order->city}}</br>
                        {{$order->state}}</br/>
                        {{$order->pincode}}
                    </div>
                    <h5 class="my-2">
                        <a href="{{ route('admin.order.index') }}"><i>Go to Orders</i> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="order_detail">
                        <h4>Order Details</h4>
                        Order ID : #{{ $order->id }}, <small style="font-weight: normal; font-style: italic;">Datetime : {{ $order->created_at }}</small><br/>
                        Order Status: 
                        @if($order->order_status == 1)
                            <span class="badge badge-warning">Placed</span>
                        @elseif ($order->order_status == 2)
                            <span class="badge badge-info">On the way</span>
                        @else
                            <span class="badge badge-success">Deliverd</span>
                        @endif
                        <br/>
                        Payment Status: 
                        @if($order->payment_status == 'PENDING')
                            <span class="badge badge-info">Pending</span>
                        @elseif ($order->payment_status == 'SUCCESS')
                            <span class="badge badge-success">Success</span>
                        @else
                            <span class="badge badge-danger">Failed</span>
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
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <div class="table-responsive cart-view-table">                                
                                <table class="table table-striped table-sm">
                                    <thead class="table-dark">
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
                                                        <img src="{{ asset('storage/product/product_attr/' . $list->productAttribute->image) }}" alt="{{ $list->product->prod_name }}" style="width: 6rem;">
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
            @break
        @default
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>                        
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <table class="table table-striped table-earning table-sm" id="example">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Details</th>
                                        <th>Total Amount</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Payment Type</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
    @endswitch
@endsection

@push('script')
    <script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $("#example").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.order.index') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'total_amt'},
                    {data: 'order_status'},
                    {data: 'payment_status'},
                    {data: 'payment_type'},
                    {data: 'created_at'}
                ],
                order: [0, 'desc']
            });
        });
    </script>
@endpush
