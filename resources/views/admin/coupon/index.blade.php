@extends('admin.layouts.app')
@section('title', 'Manage Coupon')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">manage coupon</h2>
                <a href="{{ route('admin.coupon.create') }}" class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>add</a>
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
                                <th>#</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Min Order</th>
                                <th>One Time</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.coupon.index') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'code', name: 'code'},
                    {data: 'value', name: 'value'},
                    {data: 'type', name: 'type'},
                    {data: 'min_order', name: 'min_order'},
                    {data: 'is_one_time', name: 'is_one_time'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });
        });
    </script>
@endpush
