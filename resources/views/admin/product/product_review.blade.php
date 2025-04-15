@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('index')
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
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select id="user_id" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-0">
                            <div class="form-group">
                                <select id="product_id" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="col-sm-1 pl-0">
                            <div class="form-group">
                                <select id="rating" class="form-control form-control-sm rounded">
                                    <option value="">Rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>                                        
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-group">
                                <select id="status" class="form-control form-control-sm rounded">
                                    <option value="">--Select Status--</option>
                                    <option value="A">Active</option>
                                    <option value="I">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <table class="table table-striped table-earning table-sm" id="example">
                                <thead>
                                    <tr>                                        
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Product Name</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Review Date</th>
                                        <th>Status</th>
                                        <th>Manage</th>
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

            var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.product-review.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.user_id = $('#user_id').val();
                        d.product_id = $('#product_id').val();
                        d.rating = $('#rating').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'rating', name: 'rating'},
                    {data: 'review', name: 'review'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });

            $(document).on('change', '#user_id', () => {
                table.draw();
            });

            $(document).on('change', '#product_id', () => {
                table.draw();
            });

            $(document).on('change', '#rating', () => {
                table.draw();
            });

            $(document).on('change', '#status', () => {
                table.draw();
            });

            $('#user_id').select2({
                placeholder: 'Search User...',
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

            $('#product_id').select2({
                placeholder: 'Search Product...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.product-list') }}",
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

            $(document).on('click', '.mark_as', function(){
                if(!confirm('Do you want to perform this action?')) {
                    return false;
                }
                let id = $(this).data('id');
                let status = $(this).data('s');

                $.ajax({
                    type: 'PUT',
                    url: "{{ route('admin.product-review.update', ':reviewId') }}".replace(':reviewId', id),
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data) {
                        if(data.status === 'success') {
                            alert(data.message);
                            window.location.reload();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
@endpush
