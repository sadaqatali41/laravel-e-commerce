@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.user.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.user.store') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="User Name.." class="form-control form-control-sm" value="{{ old('name') }}">
                                            @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="email" class=" form-control-label">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Email.." class="form-control form-control-sm" value="{{ old('email') }}">
                                            @error('email')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="mobile" class=" form-control-label">Mobile</label>
                                            <input type="text" id="mobile" name="mobile" placeholder="Mobile.." class="form-control form-control-sm" value="{{ old('mobile') }}">
                                            @error('mobile')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="password" class=" form-control-label">Password</label>
                                            <input type="text" id="password" name="password" placeholder="Password.." class="form-control form-control-sm" value="{{ old('password') }}">
                                            @error('password')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address" class="form-control-label">Address</label>
                                            <input type="text" id="address" name="address" placeholder="Address.." class="form-control form-control-sm" value="{{ old('address') }}">
                                            @error('address')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="city" class="form-control-label">City</label>
                                            <input type="text" id="city" name="city" placeholder="City.." class="form-control form-control-sm" value="{{ old('city') }}">
                                            @error('city')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="state" class="form-control-label">State</label>
                                            <input type="text" id="state" name="state" placeholder="State.." class="form-control form-control-sm" value="{{ old('state') }}">
                                            @error('state')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="company" class="form-control-label">Company</label>
                                            <input type="text" id="company" name="company" placeholder="Company.." class="form-control form-control-sm" value="{{ old('company') }}">
                                            @error('company')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="gstin" class="form-control-label">GSTIN</label>
                                            <input type="text" id="gstin" name="gstin" placeholder="GSTIN.." class="form-control form-control-sm" value="{{ old('gstin') }}">
                                            @error('gstin')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="zip" class="form-control-label">ZIP</label>
                                            <input type="text" id="zip" name="zip" placeholder="ZIP.." class="form-control form-control-sm" value="{{ old('zip') }}">
                                            @error('zip')<span class="help-block status--denied">{{ $message }}</span>@enderror
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
            @break
        @case('edit')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.user.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="User Name.." class="form-control form-control-sm" value="{{ old('name', $user->name) }}">
                                            @error('name')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="email" class=" form-control-label">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Email.." class="form-control form-control-sm" value="{{ old('email', $user->email) }}">
                                            @error('email')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="mobile" class=" form-control-label">Mobile</label>
                                            <input type="text" id="mobile" name="mobile" placeholder="Mobile.." class="form-control form-control-sm" value="{{ old('mobile', $user->mobile) }}">
                                            @error('mobile')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                                                       
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="password" class=" form-control-label">Password</label>
                                            <input type="text" id="password" name="password" placeholder="Password.." class="form-control form-control-sm" value="{{ old('password') }}" readonly>
                                            @error('password')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address" class="form-control-label">Address</label>
                                            <input type="text" id="address" name="address" placeholder="Address.." class="form-control form-control-sm" value="{{ old('address', $user->address) }}">
                                            @error('address')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="city" class="form-control-label">City</label>
                                            <input type="text" id="city" name="city" placeholder="City.." class="form-control form-control-sm" value="{{ old('city', $user->city) }}">
                                            @error('city')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="state" class="form-control-label">State</label>
                                            <input type="text" id="state" name="state" placeholder="State.." class="form-control form-control-sm" value="{{ old('state', $user->state) }}">
                                            @error('state')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="company" class="form-control-label">Company</label>
                                            <input type="text" id="company" name="company" placeholder="Company.." class="form-control form-control-sm" value="{{ old('company', $user->company) }}">
                                            @error('company')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="gstin" class="form-control-label">GSTIN</label>
                                            <input type="text" id="gstin" name="gstin" placeholder="GSTIN.." class="form-control form-control-sm" value="{{ old('gstin', $user->gstin) }}">
                                            @error('gstin')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="zip" class="form-control-label">ZIP</label>
                                            <input type="text" id="zip" name="zip" placeholder="ZIP.." class="form-control form-control-sm" value="{{ old('zip', $user->zip) }}">
                                            @error('zip')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if(old('status', $user->status) === 'A') selected @endif>Active</option>
                                                <option value="I" @if(old('status', $user->status) === 'I') selected @endif>Inactive</option>
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
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.user.create') }}" class="au-btn au-btn-icon au-btn--blue">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>ZipCode</th>
                                        <th>IP</th>
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
                scrollX: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.user.index') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'address', name: 'address'},
                    {data: 'city', name: 'city'},
                    {data: 'state', name: 'state'},
                    {data: 'zip', name: 'zip'},
                    {data: 'ip', name: 'ip'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });
        });
    </script>
@endpush
