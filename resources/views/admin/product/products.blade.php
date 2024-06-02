@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="post">
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
                                            <label for="prod_name" class=" form-control-label">Product Name</label>
                                            <input type="text" id="prod_name" name="prod_name" placeholder="Product Name.."
                                                class="form-control form-control-sm" value="{{ old('name') }}">
                                            @error('prod_name')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Product Slug.."
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
                                            <label for="brand_id" class=" form-control-label">Brand Name</label>
                                            <input type="text" id="brand_id" name="brand_id" placeholder="Brand Name.."
                                                class="form-control form-control-sm" value="{{ old('brand_id') }}">
                                            @error('brand_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="model_id" class=" form-control-label">Model Name</label>
                                            <input type="text" id="model_id" name="model_id" placeholder="Model Name.."
                                                class="form-control form-control-sm" value="{{ old('model_id') }}">
                                            @error('model_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="keywords" class=" form-control-label">Keywords</label>
                                            <input type="text" id="keywords" name="keywords" placeholder="Keywords.."
                                                class="form-control form-control-sm" value="{{ old('keywords') }}">
                                            @error('keywords')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description" rows="8">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="short_desc" class=" form-control-label">Short Description</label>
                                            <textarea name="short_desc" id="short_desc" class="form-control" placeholder="Short Description" rows="8">{{ old('short_desc') }}</textarea>
                                            @error('short_desc')
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
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id" class=" form-control-label">Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control form-control-sm">
                                                <option selected value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                                            </select>
                                            @error('category_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prod_name" class=" form-control-label">Product Name</label>
                                            <input type="text" id="prod_name" name="prod_name" placeholder="Product Name.."
                                                class="form-control form-control-sm" value="{{ old('name', $product->prod_name) }}">
                                            @error('prod_name')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Product Slug.."
                                                class="form-control form-control-sm" value="{{ old('slug', $product->slug) }}">
                                            @error('slug')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_id" class=" form-control-label">Brand Name</label>
                                            <input type="text" id="brand_id" name="brand_id" placeholder="Brand Name.."
                                                class="form-control form-control-sm" value="{{ old('brand_id', $product->brand_id) }}">
                                            @error('brand_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="model_id" class=" form-control-label">Model Name</label>
                                            <input type="text" id="model_id" name="model_id" placeholder="Model Name.."
                                                class="form-control form-control-sm" value="{{ old('model_id', $product->model_id) }}">
                                            @error('model_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="keywords" class=" form-control-label">Keywords</label>
                                            <input type="text" id="keywords" name="keywords" placeholder="Keywords.."
                                                class="form-control form-control-sm" value="{{ old('keywords', $product->keywords) }}">
                                            @error('keywords')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description" rows="8">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="short_desc" class=" form-control-label">Short Description</label>
                                            <textarea name="short_desc" id="short_desc" class="form-control" placeholder="Short Description" rows="8">{{ old('short_desc', $product->short_desc) }}</textarea>
                                            @error('short_desc')
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
                                                <option value="A" @if (old('status', $product->status) === 'A') selected @endif>Active
                                                </option>
                                                <option value="I" @if (old('status', $product->status) === 'I') selected @endif>Inactive
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
                                        @if (isset($product->image))
                                            <img src="{{ asset('storage/product/'. $product->image) }}" alt="Product Image" class="img-fluid mb-1">
                                        @endif
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
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.create') }}" class="au-btn au-btn-icon au-btn--blue">
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
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Product Slug</th>
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

            $("#example").DataTable({
                processing: true,
                serverSide: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.product.index') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'prod_name', name: 'prod_name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'slug', name: 'slug'},
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
        });
    </script>
@endpush
