<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('admin.index');

    // }
    public function dashboardMetrics()
    {
        $totalEarnings = Order::where('status', 'completed')->sum('total_price');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

         return view('admin.index', compact('totalEarnings', 'totalOrders', 'pendingOrders', 'completedOrders'));
    }

}
