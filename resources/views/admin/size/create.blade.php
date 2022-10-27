@extends('admin.layouts.app')
@section('title', 'Create Size')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">create size</h2>
                <a href="{{ route('admin.size.index') }}" class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-eye"></i>View</a>
            </div>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <form action="{{ route('admin.size.store') }}" method="post">
                        @csrf                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="size" class=" form-control-label">Size</label>
                                    <input type="text" id="size" name="size" placeholder="Size.." class="form-control form-control-sm" value="{{ old('size') }}">
                                    @error('size')<span class="help-block status--denied">{{ $message }}</span>@enderror
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
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
