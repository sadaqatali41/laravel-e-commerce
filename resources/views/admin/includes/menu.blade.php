<li class="@if(request()->routeIs('admin.dashboard')) active @endif">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
</li>
<li class="@if(request()->routeIs('admin.slider.*')) active @endif">
    <a href="{{ route('admin.slider.index') }}">
        <i class="fas fa-sliders-h"></i>Slider</a>
</li>
<li class="@if(request()->routeIs('admin.category.*')) active @endif">
    <a href="{{ route('admin.category.index') }}">
        <i class="fas fa-list"></i>Categories</a>
</li>
<li class="@if(request()->routeIs('admin.subcategory.*')) active @endif">
    <a href="{{ route('admin.subcategory.index') }}">
        <i class="fas fa-list-alt"></i>Sub Categories</a>
</li>
<li class="@if(request()->routeIs('admin.coupon.*')) active @endif">
    <a href="{{ route('admin.coupon.index') }}">
        <i class="fa fa-gift"></i>Coupons</a>
</li>
<li class="@if(request()->routeIs('admin.size.*')) active @endif">
    <a href="{{ route('admin.size.index') }}">
        <i class="fa fa-balance-scale"></i>Sizes</a>
</li>
<li class="@if(request()->routeIs('admin.color.*')) active @endif">
    <a href="{{ route('admin.color.index') }}">
        <i class="fa fa-paint-brush"></i>Colors</a>
</li>
<li class="@if(request()->routeIs('admin.brand.*')) active @endif">
    <a href="{{ route('admin.brand.index') }}">
        <i class="fa fa-bandcamp"></i>Brands</a>
</li>
<li class="@if(request()->routeIs('admin.tax.*')) active @endif">
    <a href="{{ route('admin.tax.index') }}">
        <i class="fa fa-percent"></i>Taxes</a>
</li>
<li class="@if(request()->routeIs('admin.product.*')) active @endif">
    <a href="{{ route('admin.product.index') }}">
        <i class="fa fa-product-hunt"></i>Products</a>
</li>
<li class="@if(request()->routeIs('admin.user.*')) active @endif">
    <a href="{{ route('admin.user.index') }}">
        <i class="fa fa-users"></i>Users</a>
</li>