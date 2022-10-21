<li class="@if(request()->routeIs('admin.dashboard')) active @endif">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
</li>
<li class="@if(request()->routeIs('admin.category.*')) active @endif">
    <a href="{{ route('admin.category.index') }}">
        <i class="fas fa-list"></i>Categories</a>
</li>