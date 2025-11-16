<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0">Milky</h1>
    </a>
    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('product') }}" class="nav-item nav-link {{ request()->routeIs('product') ? 'active' : '' }}">Products</a>

            @php
                $userToken = session('user_token');
                $user = $userToken ? \Tymon\JWTAuth\Facades\JWTAuth::setToken($userToken)->authenticate() : null;
            @endphp

            @if($user)
                <a href="{{ route('myorder') }}" class="nav-item nav-link {{ request()->routeIs('myorder') ? 'active' : '' }}">My Orders</a>
                <a href="{{ route('cart') }}" class="nav-item nav-link {{ request()->routeIs('cart') ? 'active' : '' }}">Cart</a>
                <a href="{{ route('wishlist') }}" class="nav-item nav-link {{ request()->routeIs('wishlist') ? 'active' : '' }}">Wishlist</a>
                <a href="{{ route('subscription.index') }}" class="nav-item nav-link {{ request()->routeIs('subscription.index') ? 'active' : '' }}">My Subscription</a>

                <form method="GET" action="{{ route('logout') }}" class="d-inline">
                    <button type="submit" class="nav-item nav-link btn btn-link">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
            @endif

            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
