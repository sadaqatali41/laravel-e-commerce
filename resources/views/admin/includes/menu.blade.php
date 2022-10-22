<li class="@if(request()->routeIs('admin.dashboard')) active @endif">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
</li>
<li class="@if(request()->routeIs('admin.category.*')) active @endif">
    <a href="{{ route('admin.category.index') }}">
        <i class="fas fa-list"></i>Categories</a>
</li>
<li class="@if(request()->routeIs('admin.coupon.*')) active @endif">
    <a href="{{ route('admin.coupon.index') }}">
        <i class="fa fa-gift"></i>Coupons</a>
</li>