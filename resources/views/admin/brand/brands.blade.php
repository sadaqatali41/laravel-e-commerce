@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.brand.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="brandAddForm" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Brand Name.." class="form-control form-control-sm" value="{{ old('name') }}">
                                            @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="is_home" class=" form-control-label">Home Page Visibility</label>
                                            <select name="is_home" id="is_home" class="form-control form-control-sm">
                                                <option value="0" @if(old('is_home') === 0) selected @endif>Do not Show on Home Page</option>
                                                <option value="1" @if(old('is_home') === 1) selected @endif>Show on Home Page</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
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
                                <button type="submit" class="btn btn-primary btn-sm" id="brandAddFormBtn">
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
                        <a href="{{ route('admin.brand.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="brandEditForm" action="{{ route('admin.brand.update', $brand->id) }}" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Brand Name.." class="form-control form-control-sm" value="{{ old('name', $brand->name) }}">
                                            @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="is_home" class=" form-control-label">Home Page Visibility</label>
                                            <select name="is_home" id="is_home" class="form-control form-control-sm">
                                                <option value="0" @if(old('is_home', $brand->is_home) === 0) selected @endif>Do not Show on Home Page</option>
                                                <option value="1" @if(old('is_home', $brand->is_home) === 1) selected @endif>Show on Home Page</option>
                                            </select>
                                        </div>
                                    </div>                            
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status', $brand->status) === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status', $brand->status) === 'I') selected @endif>Inactive</option>
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">                                        
                                        @if (isset($brand->image))
                                            <img src="{{ asset('storage/brand/'. $brand->image) }}" alt="Brand Image" class="img-fluid mb-1">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="brandEditFormBtn">
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
                        <a href="{{ route('admin.brand.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select id="is_home" class="form-control form-control-sm rounded">
                                    <option value="">--Select Visibility--</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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
                                        <th>Brand Name</th>
                                        <th>Image</th>
                                        <th>Home Visibility</th>
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
                    url: "{{ route('admin.brand.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.is_home = $('#is_home').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'is_home', name: 'is_home'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });

            $(document).on('change', '#is_home', () => {
                table.draw();
            });

            $(document).on('change', '#status', () => {
                table.draw();
            });

            $(document).on('submit', '#brandAddForm', function(e){
                e.preventDefault();
                
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#brandAddFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#brandAddFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });

            $(document).on('submit', '#brandEditForm', function(e){
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
                        $('#brandEditFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#brandEditFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });
        });
    </script>
@endpush
