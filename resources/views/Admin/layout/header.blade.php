<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-inline">
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
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Milky Admin</span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-header">Management</li>

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.sellers.index') }}"
                    class="nav-link {{ request()->routeIs('admin.sellers.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Sellers</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Categories</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}"
                    class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>Products</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Orders</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.contact.index') }}"
                    class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-messager"></i>
                    <p>Contact Messages</p>
                </a>
            </li>

            <li class="nav-header">CMS</li>
            <li class="nav-item">
                <a href="{{ route('admin.cms.index') }}"
                    class="nav-link {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>CMS</p>
                </a>
            </li>


            <li class="nav-header">Account</li>
            <li class="nav-item">
                <a href="{{ route('admin.profile') }}"
                    class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>Admin Profile</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</aside>