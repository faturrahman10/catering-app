<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return view('dashboard', [
            'totalOrders' => Order::count(),

            'todayOrders' => Order::whereDate('order_date', $today)->count(),

            'totalRevenue' => Order::where('status', '!=', 'canceled')->sum('total_price'),

            'activeMenus' => Menu::where('is_active', true)->count(),

            'latestOrders' => Order::with('customer')->latest()->limit(5)->get(),
        ]);
    }
}
