@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">dashboard</h2>
            </div>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $totalUsers  }}</h2>
                            <span>Total Users</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $totalProducts  }}</h2>
                            <span>Total Products</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $totalOrders }}</h2>
                            <span>Total Orders</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c4">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $todaysSales }}</h2>
                            <span>Today's Sales</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c5">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $pendingOrders }}</h2>
                            <span>Pending Orders</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c6">
                <div class="overview__inner">
                    <div class="overview-box clearfix">                        
                        <div class="text">
                            <h2>{{ $lowStockProducts }}</h2>
                            <span>Low Stock (&lt; 5 qty)</span>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection
