<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form id="logout-form" 
                  action="{{ auth()->guard(session('admin_guard') ?? 'admin')->check() ? route('admin.logout') : route('seller.logout') }}" 
                  method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ auth()->guard(session('admin_guard') ?? 'admin')->check() ? route('admin.dashboard') : route('admin.seller.dashboard') }}" 
       class="brand-link">
        <span class="brand-text font-weight-light">Milky Admin</span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            @php
                $guard = session('admin_guard') ?? 'admin';
            @endphp

            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ $guard === 'admin' ? route('admin.dashboard') : route('admin.seller.dashboard') }}"
                   class="nav-link {{ request()->routeIs($guard === 'admin' ? 'admin.dashboard' : 'admin.seller.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            {{-- Management --}}
            @if($guard === 'admin' || $guard === 'seller')
                <li class="nav-header">Management</li>

                {{-- Categories --}}
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                       class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                {{-- Products --}}
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}"
                       class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Products</p>
                    </a>
                </li>

                {{-- Orders --}}
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}"
                       class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Orders</p>
                    </a>
                </li>
            @endif

            {{-- Account --}}
            <li class="nav-header">Account</li>
            <li class="nav-item">
                <a href="{{ route('admin.profile') }}"
                   class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>Profile</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</aside>
