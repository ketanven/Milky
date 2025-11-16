<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::with(['seller', 'category'])->get();

        return view('index', compact('products'));
    }
    public function product()
    {
        // Fetch all products with seller and category relationships
        $products = Product::with(['seller', 'category'])->get();

        // Pass to view
        return view('product', compact('products'));
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function myorder()
    {
        return view('myorder');
    }
    public function cart()
    {
        return view('cart');
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function contact()
    {
        return view('contact');
    }
}
