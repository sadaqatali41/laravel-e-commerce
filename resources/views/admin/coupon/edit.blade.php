@extends('admin.layouts.app')
@section('title', 'Update Coupon')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">update coupon</h2>
                <a href="{{ route('admin.coupon.index') }}" class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-eye"></i>View</a>
            </div>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                        @csrf
                        @method('PUT')
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
                                        <option value="A" @if(old('status', $coupon->status) === 'A') selected @endif>Active</option>
                                        <option value="I" @if(old('status', $coupon->status) === 'I') selected @endif>Inactive</option>
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
