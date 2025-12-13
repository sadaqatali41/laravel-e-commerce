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
                            <form id="couponAddForm" action="{{ route('admin.coupon.store') }}" method="post">
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
                                                @foreach (App\Enums\EntityStatus::toArray() as $key => $value)
                                                    <option value="{{ $key }}" @if(old('status') === $key) selected @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                </div>                        
                                <button type="submit" class="btn btn-primary btn-sm" id="couponAddFormBtn">
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
                            <form id="couponEditForm" action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tite" class=" form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Title.." class="form-control form-control-sm" value="{{ old('title', $coupon->title) }}">
                                            @error('title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="code" class=" form-control-label">Code</label>
                                            <input type="text" id="code" name="code" placeholder="Code.." class="form-control form-control-sm" value="{{ old('code', $coupon->code) }}">
                                            @error('code')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="value" class=" form-control-label">Value</label>
                                            <input type="text" id="value" name="value" placeholder="Value.." class="form-control form-control-sm" value="{{ old('value', $coupon->value) }}">
                                            @error('value')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="type" class=" form-control-label">Type</label>
                                            <select name="type" id="type" class="form-control form-control-sm">
                                                <option value="P" @if(old('type', $coupon->type) === 'P') selected @endif>Percent</option>
                                                <option value="V" @if(old('type', $coupon->type) === 'V') selected @endif>Value</option>
                                            </select>
                                            @error('type')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="min_order" class=" form-control-label">Min Order</label>
                                            <input type="text" id="min_order" name="min_order" placeholder="Min Order.." class="form-control form-control-sm" value="{{ old('min_order', $coupon->min_order) }}">
                                            @error('min_order')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="is_one_time" class=" form-control-label">One Time ?</label>
                                            <select name="is_one_time" id="is_one_time" class="form-control form-control-sm">
                                                <option value="1" @if(old('is_one_time', $coupon->is_one_time) === '1') selected @endif>Yes</option>
                                                <option value="0" @if(old('is_one_time', $coupon->is_one_time) === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_one_time')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                @foreach (App\Enums\EntityStatus::toArray() as $key => $value)
                                                    <option value="{{ $key }}" @if(old('status', $coupon->status->value) === $key) selected @endif>{{ $value }}</option>                                                    
                                                @endforeach
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                </div>                        
                                <button type="submit" class="btn btn-primary btn-sm" id="couponEditFormBtn">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
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
                        <a href="{{ route('admin.coupon.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-2">
                            <select id="type" class="form-control form-control-sm rounded">
                                <option value="">--Select Type--</option>
                                <option value="P">Percent</option>
                                <option value="V">Value</option>
                            </select>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <select id="is_one_time" class="form-control form-control-sm rounded">
                                <option value="">--Select OneTime--</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <div class="form-group">
                                <select id="status" class="form-control form-control-sm rounded">
                                    <option value="">--Select Status--</option>
                                    @foreach (App\Enums\EntityStatus::toArray() as $key => $value)
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
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.coupon.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.type = $('#type').val();
                        d.is_one_time = $('#is_one_time').val();
                        d.status = $('#status').val();
                    }
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

            $(document).on('change', '#type', () => {
                table.draw();
            });

            $(document).on('change', '#is_one_time', () => {
                table.draw();
            });

            $(document).on('change', '#status', () => {
                table.draw();
            });

            $(document).on('submit', '#couponAddForm', function(e){
                e.preventDefault();
                
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#couponAddFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);                            
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#couponAddFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });

            $(document).on('submit', '#couponEditForm', function(e){
                e.preventDefault();
                
                var formData = new FormData(this);
                formData.append('_method', 'PUT');
                
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#couponEditFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);                            
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#couponEditFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });
        });
    </script>
@endpush
