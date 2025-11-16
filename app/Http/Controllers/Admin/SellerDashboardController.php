<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerDashboardController extends Controller
{
    public function sellerDashboard()
    {
        $seller = auth()->user();
        Log::info('Seller dashboard accessed', ['user_id' => $seller->id]);

        // Seller-specific stats
        $productCount = Product::where('seller_id', $seller->id)->count();
        $orderCount = Order::count();


        $totalRevenue = Order::whereHas('orderItems', function($q) use ($seller) {
            $q->whereIn('product_id', Product::where('seller_id', $seller->id)->pluck('id'));
        })->sum('total_amount');

        // Dummy chart data (replace with real if available)
        $dailyVisitors = [
            'today' => rand(50, 200),
            'yesterday' => rand(30, 150),
        ];

        $monthlySales = [
            'thisMonth' => rand(10000, 50000),
            'lastMonth' => rand(8000, 40000),
        ];

        return view('Admin.sellerDashboard', compact(
            'seller', 
            'productCount', 
            'orderCount', 
            'totalRevenue',
            'dailyVisitors',
            'monthlySales'
        ));
    }
}
