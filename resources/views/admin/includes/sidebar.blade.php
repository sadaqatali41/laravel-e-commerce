<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">                
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-list"></i>Categories</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>