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
                                    @foreach (App\Enums\OrderStatus::toArray() as $key => $value)
                                        <option value="{{ $key }}" @if($order->order_status->value === $key) selected @endif>{{ $value }}</option>
                                    @endforeach                                    
                                </select>                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="payment_status" class="form-control-label">Update Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control form-control-sm">
                                    @foreach (App\Enums\PaymentStatus::toArray() as $key => $value)
                                        <option value="{{ $key }}" @if($order->payment_status->value === $key) selected @endif>{{ $value }}</option>
                                    @endforeach
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
                                <span class="badge badge-{{ str_replace('label-', '', $order->order_status->color()) }}">{{ $order->order_status->label() }}</span>                                
                                <br/>
                                Payment Status: 
                                <span class="badge badge-{{ str_replace('label-', '', $order->payment_status->color()) }}">{{ $order->payment_status->label() }}</span>                                
                                <br/>
                                Payment Type: 
                                {{ $order->payment_type->label() }}
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
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select id="user_id" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-group">
                                <select id="order_status_filter" class="form-control form-control-sm">
                                    <option value="">--Order Status--</option>
                                    @foreach (App\Enums\OrderStatus::toArray() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>                                        
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-group">
                                <select id="payment_status_filter" class="form-control form-control-sm rounded">
                                    <option value="">--Payment Status--</option>
                                    @foreach (App\Enums\PaymentStatus::toArray() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-group">
                                <select id="payment_type_filter" class="form-control form-control-sm rounded">
                                    <option value="">--Payment Type--</option>
                                    @foreach (App\Enums\PaymentType::toArray() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <table class="table table-striped table-earning table-sm" id="example">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order By</th>
                                        <th>Detail Address</th>
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
                                    <label for="trackings" class="form-control-label">Tracking Details</label>
                                    <input type="text" id="trackings" name="trackings" placeholder="Tracking Details.." class="form-control form-control-sm">
                                    @isset($order->id)
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">                                        
                                    @endisset
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
                        <dl>
                            @foreach($order->trackings as $key => $tracking)
                                <dt class="font-weight-normal">{{ $tracking->trackings }}</dt>
                                <dd class="font-weight-light font-italic m-l-15"><i class="far fa-clock"></i> {{ $tracking->created_at }}</dd>
                            @endforeach
                        </dl>
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

            var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.order.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.user_id = $('#user_id').val();
                        d.order_status = $('#order_status_filter').val();
                        d.payment_status = $('#payment_status_filter').val();
                        d.payment_type = $('#payment_type_filter').val();
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'user_id'},
                    {data: 'name'},
                    {data: 'total_amt'},
                    {data: 'order_status'},
                    {data: 'payment_status'},
                    {data: 'payment_type'},
                    {data: 'created_at'}
                ],
                order: [0, 'desc']
            });

            $(document).on('change', '#user_id', () => {
                table.draw();
            });

            $(document).on('change', '#order_status_filter', () => {
                table.draw();
            });

            $(document).on('change', '#payment_status_filter', () => {
                table.draw();
            });

            $(document).on('change', '#payment_type_filter', () => {
                table.draw();
            });

            $('#user_id').select2({
                placeholder: 'Search Order By...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.user-list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
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

            $('#trackOrderModal').on('hidden.bs.modal', function(){
                $('.error-message').remove();
            });
        });
    </script>
@endpush
