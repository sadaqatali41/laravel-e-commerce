@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.slider.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="sliderAddForm" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data" method="post">                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Title.." class="form-control form-control-sm" value="{{ old('title') }}">
                                            @error('title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="short_title" class="form-control-label">Short Title</label>
                                            <input type="text" id="short_title" name="short_title" placeholder="Short Title.." class="form-control form-control-sm" value="{{ old('short_title') }}">
                                            @error('short_title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Description</label>
                                            <input type="text" id="description" name="description" placeholder="Description.." class="form-control form-control-sm" value="{{ old('description') }}">
                                            @error('description')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id" class="form-control-label">Category</label>
                                            <select name="category_id" id="category_id" class="form-control form-control-sm"></select>
                                            @error('category_id')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class="form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status') === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status') === 'I') selected @endif>Inactive</option>
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            <small id="image" class="form-text text-muted">exact 1920 x 700</small>
                                            @error('image')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="sliderAddFormBtn">
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
                        <a href="{{ route('admin.slider.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="sliderEditForm" action="{{ route('admin.slider.update', $slider->id) }}" enctype="multipart/form-data">                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="title" class=" form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Title.." class="form-control form-control-sm" value="{{ old('title', $slider->title) }}">
                                            @error('title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="short_title" class=" form-control-label">Short Title</label>
                                            <input type="text" id="short_title" name="short_title" placeholder="Short Title.." class="form-control form-control-sm" value="{{ old('short_title', $slider->short_title) }}">
                                            @error('short_title')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <input type="text" id="description" name="description" placeholder="Description.." class="form-control form-control-sm" value="{{ old('description', $slider->description) }}">
                                            @error('description')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id" class="form-control-label">Category</label>
                                            <select name="category_id" id="category_id" class="form-control form-control-sm">
                                                @if ($slider->category !== null)
                                                <option value="{{ $slider->category_id }}">{{ $slider->category->name }}</option>   
                                                @endif
                                            </select>
                                            @error('category_id')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status', $slider->status) === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status', $slider->status) === 'I') selected @endif>Inactive</option>
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                        @if (isset($slider->image))
                                            <img src="{{ asset('storage/slider/'. $slider->image) }}" alt="Slider Image" class="img-fluid mb-1">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="sliderEditFormBtn">
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
                        <a href="{{ route('admin.slider.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select id="category_id" class="form-control form-control-sm"></select>
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
                            <table class="table table-striped table-earning table-sm" id="example" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Short Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
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
                    url: "{{ route('admin.slider.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.category_id = $('#category_id').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'title', name: 'title'},
                    {data: 'short_title', name: 'short_title'},
                    {data: 'description', name: 'description'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });

            $('#category_id').select2({
                placeholder: 'Search Category...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.category-list') }}",
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

            $(document).on('change', '#category_id', () => {
                table.draw();
            });

            $(document).on('change', '#status', () => {
                table.draw();
            });

            $(document).on('submit', '#sliderAddForm', function(e){
                e.preventDefault();
                
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#sliderAddFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            if ($input.hasClass('select2-hidden-accessible')) {
                                $input.next('.select2-container').after(`<span class="help-block status--denied">${message[0]}</span>`);
                            } else {
                                $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                            }
                        });                        
                        $('#sliderAddFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });

            $(document).on('submit', '#sliderEditForm', function(e){
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
                        $('#sliderEditFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            if ($input.hasClass('select2-hidden-accessible')) {
                                $input.next('.select2-container').after(`<span class="help-block status--denied">${message[0]}</span>`);
                            } else {
                                $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                            }
                        });                        
                        $('#sliderEditFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });
        });
    </script>
@endpush
