<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CMSPageController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SellerDashboardController;
use App\Http\Controllers\Admin\SellersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Web\CartWishlistController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\RedirectIfUserLoggedIn;
use App\Http\Middleware\UserAuthMiddleware;

// --------------------------
// Guest-only routes
// --------------------------
Route::middleware([RedirectIfUserLoggedIn::class])->group(function () {
    Route::get("/register", [UserController::class, "showRegister"])->name('register');
    Route::post("/register", [UserController::class, "storeRegister"])->name('register.store');
    Route::get("/login", [UserController::class, "showLogin"])->name('login');
    Route::post("/login", [UserController::class, "login"])->name('login.post');
});

Route::post('/checkout/stripe-session', [OrderController::class, 'createStripeSession'])->name('checkout.stripeSession');
Route::get('/checkout/success', [OrderController::class, 'stripeSuccess'])->name('checkout.stripeSuccess');



// --------------------------
// Authenticated (User) routes
// --------------------------
Route::middleware([UserAuthMiddleware::class])->group(function () {
    Route::get("/logout", [UserController::class, "logout"])->name('logout');
    Route::get("/my-order", [HomeController::class, "myorder"])->name('myorder');

    Route::get("/my-cart", [CartWishlistController::class, "cart"])->name('cart');
    Route::get("/wishlist", [CartWishlistController::class, "wishlist"])->name('wishlist');

    Route::post('/add-to-cart/{product}', [CartWishlistController::class, 'addToCart'])->name('add.to.cart');
    Route::post('/update-cart/{cart}', [CartWishlistController::class, 'updateCart'])->name('update.cart');
    Route::post('/remove-cart/{cart}', [CartWishlistController::class, 'removeCart'])->name('remove.cart');

    Route::post('/add-to-wishlist/{product}', [CartWishlistController::class, 'addToWishlist'])->name('add.to.wishlist');
    Route::post('/remove-wishlist/{wishlist}', [CartWishlistController::class, 'removeWishlist'])->name('remove.wishlist');
    Route::post('/add-to-cart-from-wishlist/{product}', [CartWishlistController::class, 'addToCartFromWishlist'])->name('add.to.cart.from.wishlist');


    //orders
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/place-order', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');

    Route::get('/my-order', [OrderController::class, 'myOrders'])->name('myorder');
    Route::post('/order/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');


    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::post('/subscription/cancel/{id}', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

// --------------------------
// Public routes
// --------------------------
Route::get("/", [HomeController::class, "home"])->name('home');
Route::get("/product", [HomeController::class, "product"])->name('product');
Route::get("/contact", [HomeController::class, "contact"])->name('contact');
Route::get('page/{slug}', [CMSPageController::class, 'show'])->name('page');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



// --------------------------
// Admin routes
// --------------------------
Route::prefix('admin-panel')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware([AdminAuthMiddleware::class])->group(function () {
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/seller-dashboard', [SellerDashboardController::class, 'sellerDashboard'])->name('seller.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Users
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/toggle', [UsersController::class, 'toggleStatus'])->name('users.toggle');

        // Sellers
        Route::resource('sellers', SellersController::class)->except(['show', 'create', 'edit']);
        Route::post('sellers/{seller}/toggle', [SellersController::class, 'toggleStatus'])->name('sellers.toggle');

        // Categories
        Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
        Route::post('categories/{category}/toggle', [CategoryController::class, 'toggleStatus'])->name('categories.toggle');

        // Products
        Route::resource('products', ProductController::class)->except(['create', 'show']);
        Route::post('products/{product}/toggle', [ProductController::class, 'toggleStatus'])->name('products.toggle');

        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        Route::get('cms', [CMSPageController::class, 'index'])->name('cms.index');
        Route::get('cms/{id}/edit', [CMSPageController::class, 'edit'])->name('cms.edit');
        Route::put('cms/{id}', [CMSPageController::class, 'update'])->name('cms.update');

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact.index');
        Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact.show');
        Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');
        
        // Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');


    });
});






