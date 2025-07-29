<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;


Route::get("/", [HomeController::class, "home"])->name('home');
Route::get("/product", [HomeController::class, "product"])->name('product');
Route::get("/register", [HomeController::class, "register"])->name('register');
Route::get("/login", [HomeController::class, "login"])->name('login');
Route::get("/my-order", [HomeController::class, "myorder"])->name('myorder');
Route::get("/my-cart", [HomeController::class, "cart"])->name('cart');
Route::get("/wishlist", [HomeController::class, "wishlist"])->name('wishlist');

