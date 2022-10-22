@extends('admin.layouts.app')
@section('title', 'Update Category')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">updte category</h2>
                <a href="{{ route('admin.category.index') }}" class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-eye"></i>View</a>
            </div>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Category Name.." class="form-control form-control-sm" value="{{ old('name', $category->name) }}">
                                    @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="slug" class=" form-control-label">Slug</label>
                                    <input type="text" id="slug" name="slug" placeholder="Category Slug.." class="form-control form-control-sm" value="{{ old('slug', $category->slug) }}">
                                    @error('slug')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class=" form-control-label">Status</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="A" @if(old('status', $category->status) === 'A') selected @endif>Active</option>
                                        <option value="I" @if(old('status', $category->status) === 'I') selected @endif>Inactive</option>
                                    </select>
                                    @error('status')<span class="help-block status--denied">{{ $message }}</span>@enderror
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
                                @if (isset($category->image))
                                    <img src="{{ asset('storage/category/'. $category->image) }}" alt="Category Image" class="img-fluid mb-1">
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
@endsection
