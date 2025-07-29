<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('index');
    }
    public function product()
    {
        return view('product');
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
}
