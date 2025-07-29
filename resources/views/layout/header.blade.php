<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0">Milky</h1>
    </a>
    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('product') }}" class="nav-item nav-link">Products</a>
            <a href="{{ route('myorder') }}" class="nav-item nav-link">My Orders</a>
            <a href="{{ route('cart') }}" class="nav-item nav-link">Cart</a>
            <a href="{{ route('wishlist') }}" class="nav-item nav-link">Wishlist</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="gallery.html" class="dropdown-item">Gallery</a>
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                </div>
            </div>

            <a href="contact.html" class="nav-item nav-link">Contact</a>
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
        </div>
        <div class="d-flex d-none d-lg-block">
            <form action="#" method="GET" class="d-flex align-items-center">
                <input type="text" name="query" class="form-control form-control-sm" placeholder="Search...">
                <button type="submit" class="btn btn-sm ms-2 p-0"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>
<!-- Navbar End -->
