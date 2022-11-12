@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">create sub category</h2>
                        <a href="{{ route('admin.subcategory.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.subcategory.store') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id" class=" form-control-label">Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control form-control-sm"></select>
                                            @error('category_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Sub Category Name.."
                                                class="form-control form-control-sm" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Sub Category Slug.."
                                                class="form-control form-control-sm" value="{{ old('slug') }}">
                                            @error('slug')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if (old('status') === 'A') selected @endif>Active
                                                </option>
                                                <option value="I" @if (old('status') === 'I') selected @endif>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
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
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">update sub category</h2>
                        <a href="{{ route('admin.subcategory.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id" class=" form-control-label">Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control form-control-sm">
                                                <option selected value="{{ $subcategory->id }}">{{ $subcategory->category->name }}</option>
                                            </select>
                                            @error('category_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Sub Category Name.." class="form-control form-control-sm" value="{{ old('name', $subcategory->name) }}">
                                            @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Sub Category Slug.." class="form-control form-control-sm" value="{{ old('slug', $subcategory->slug) }}">
                                            @error('slug')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                              
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                        @if (isset($subcategory->image))
                                            <img src="{{ asset('storage/subcategory/'. $subcategory->image) }}" alt="Category Image" class="img-fluid mb-1">
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status', $subcategory->status) === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status', $subcategory->status) === 'I') selected @endif>Inactive</option>
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

        @default
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">manage sub category</h2>
                        <a href="{{ route('admin.subcategory.create') }}" class="au-btn au-btn-icon au-btn--blue">
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
                                        <th>Category Name</th>
                                        <th>Name</th>
                                        <th>Slug</th>
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
        $(function() {

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
                    url: "{{ route('admin.subcategory.index') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'manage',
                        name: 'manage',
                        orderable: false,
                        searchable: false
                    },
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
        });
    </script>
@endpush
