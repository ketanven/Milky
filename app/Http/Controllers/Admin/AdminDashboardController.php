<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Top summary counts
        $userCount = User::where('is_active', 1)->count();
        $sellerCount = User::where('role', 'seller')->where('is_active', 1)->count();
        $orderCount = Order::count();

        // Dummy chart data
        $dailyVisitors = [
            'today' => rand(100, 200),
            'yesterday' => rand(50, 150),
        ];

        $monthlySales = [
            'thisMonth' => rand(50000, 200000),
            'lastMonth' => rand(40000, 180000),
        ];

        return view('Admin.index', compact(
            'userCount', 
            'sellerCount', 
            'orderCount', 
            'dailyVisitors', 
            'monthlySales'
        ));
    }
}
