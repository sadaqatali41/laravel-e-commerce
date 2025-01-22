@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('edit')
            <div class="au-card m-b-10">
                <div class="au-card-inner">
                    <div class="row">                                                   
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="order_status" class="form-control-label">Update Order Status</label>
                                <select name="order_status" id="order_status" class="form-control form-control-sm">
                                    <option value="1" @if($order->order_status === 1) selected @endif>Placed</option>
                                    <option value="2" @if($order->order_status === 2) selected @endif>On the way</option>
                                    <option value="3" @if($order->order_status === 3) selected @endif>Deliverd</option>
                                    <option value="4" @if($order->order_status === 4) selected @endif>Cancelled</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="payment_status" class="form-control-label">Update Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control form-control-sm">
                                    <option value="PENDING" @if($order->payment_status === 'PENDING') selected @endif>Pending</option>
                                    <option value="SUCCESS" @if($order->payment_status === 'SUCCESS') selected @endif>Success</option>
                                    <option value="FAILED" @if($order->payment_status === 'FAILED') selected @endif>Failed</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="track_detail" class="form-control-label">Track Details</label>
                                <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="modal" data-target="#trackOrderModal">Track Order</button>
                            </div>
                        </div>                        
                        <input type="hidden" id="order_id" value="{{ $order->id }}">
                    </div>
                </div>
            </div>
            <div class="au-card m-b-10">
                <div class="au-card-inner">
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
                </div>
            </div>
            <div class="row">
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

@section('modal')
    <!-- modal medium -->
    <div class="modal fade" id="trackOrderModal" tabindex="-1" role="dialog" aria-labelledby="trackOrderModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackOrderModalLabel">Medium Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.order.store') }}" id="orderTrackFrom">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="courier_name" class="form-control-label">Courier Name</label>
                                    <input type="text" id="courier_name" name="courier_name" placeholder="Courier Name.." class="form-control form-control-sm">
                                    @isset($order->id)
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">                                        
                                    @endisset
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="tracking_number" class="form-control-label">Tracking Number</label>
                                    <input type="text" id="tracking_number" name="tracking_number" placeholder="Tracking Number.." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-2" style="margin-top: 2.1em;">
                                <button type="submit" class="btn btn-primary btn-sm" id="orderTrackFromBtn">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    @isset($order->trackings)
                        <ul class="timeline">
                            @foreach($order->trackings as $tracking)
                            <li class="timeline-item">
                                <div class="timeline-content">                                        
                                    <p><strong>Courier Name:</strong> {{ $tracking->courier_name }}</p>
                                    <p><strong>Tracking Number:</strong> {{ $tracking->tracking_number }}</p>
                                    <small><i class="far fa-clock"></i> {{ $tracking->updated_at }}</small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endisset
                </div>                
            </div>
        </div>
    </div>
    <!-- end modal medium -->
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

            $(document).on('change', '#order_status', function(){
                let order_status = $(this).val();
                let order_id = $('#order_id').val();
                updateStatus('order_status', order_status, order_id);
            });

            $(document).on('change', '#payment_status', function(){
                let payment_status = $(this).val();
                let order_id = $('#order_id').val();
                updateStatus('payment_status', payment_status, order_id);
            });

            function updateStatus(columnName, columnVal, orderId) {
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.order.update', ':order_id') }}".replace(':order_id', orderId),
                    data: {
                        'column_name': columnName,
                        'column_val': columnVal
                    },
                    success: function(data) {
                        if(data.status) {
                            alert(data.message);
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            let errorStyle = `margin-top: 0; color: red; display: block`;

            $(document).on('submit', '#orderTrackFrom', function(e){
                e.preventDefault();
                $('.error-message').remove();
                $('#orderTrackFromBtn').attr('disabled', true).text('Loading...');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data){
                        if(data.status === 'success') {
                            alert(data.message);
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key).after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
                        });                        
                        $('#orderTrackFromBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    }
                });
            });
        });
    </script>
@endpush
