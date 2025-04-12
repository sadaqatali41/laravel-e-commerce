@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.tax.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="taxAddForm" action="{{ route('admin.tax.store') }}" method="post">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tax_per" class=" form-control-label">Tax %</label>
                                            <input type="text" id="tax_per" name="tax_per" placeholder="Tax Percent.." class="form-control form-control-sm" value="{{ old('tax_per') }}">
                                            @error('tax_per')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tax_desc" class=" form-control-label">Tax Description</label>
                                            <input type="text" id="tax_desc" name="tax_desc" placeholder="Tax Description.." class="form-control form-control-sm" value="{{ old('tax_desc') }}">
                                            @error('tax_desc')<span class="help-block status--denied">{{ $message }}</span>@enderror
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
                                <button type="submit" class="btn btn-primary btn-sm" id="taxAddFormBtn">
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
                        <a href="{{ route('admin.tax.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form id="taxEditForm" action="{{ route('admin.tax.update', $tax->id) }}" method="post">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tax_per" class=" form-control-label">Tax %</label>
                                            <input type="text" id="tax_per" name="tax_per" placeholder="Tax Percent.." class="form-control form-control-sm" value="{{ old('tax_per', $tax->tax_per) }}">
                                            @error('tax_per')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tax_desc" class=" form-control-label">Tax Description</label>
                                            <input type="text" id="tax_desc" name="tax_desc" placeholder="Tax Description.." class="form-control form-control-sm" value="{{ old('tax_desc', $tax->tax_desc) }}">
                                            @error('tax_desc')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status', $tax->status) === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status', $tax->status) === 'I') selected @endif>Inactive</option>
                                            </select>
                                            @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                            
                                </div>                        
                                <button type="submit" class="btn btn-primary btn-sm" id="taxEditFormBtn">
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
                        <a href="{{ route('admin.tax.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="row">                        
                        <div class="col-sm-2">
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
                                        <th>Tax Percentage</th>
                                        <th>Tax Description</th>
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
                    url: "{{ route('admin.tax.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'tax_per', name: 'tax_per'},
                    {data: 'tax_desc', name: 'tax_desc'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });

            $(document).on('change', '#status', () => {
                table.draw();
            });

            $(document).on('submit', '#taxAddForm', function(e){
                e.preventDefault();
                
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#taxAddFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#taxAddFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });

            $(document).on('submit', '#taxEditForm', function(e){
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
                        $('#taxEditFormBtn').attr('disabled', true).html('Loading.....');
                        $('.status--denied').remove();
                    },
                    error: function(response) {
                        let formErrors = response.responseJSON.errors;
                        $.each(formErrors, function(field, message){
                            let $input = $('#' + field);
                            $input.after(`<span class="help-block status--denied">${message[0]}</span>`);
                        });                        
                        $('#taxEditFormBtn').attr('disabled', false).html('<i class="fa fa-dot-circle-o"></i> Submit');
                    },
                    success: function(response) {                        
                        window.location.reload();
                    },
                });
            });
        });
    </script>
@endpush
