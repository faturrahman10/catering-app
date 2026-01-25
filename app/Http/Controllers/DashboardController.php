<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Income;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $lastMonth = Carbon::now()->subMonth();

        // ========== STATISTIK KARTU ==========

        // Total Orders dengan perbandingan bulan lalu
        $totalOrders = Order::count();
        $lastMonthOrders = Order::whereMonth('order_date', $lastMonth->month)->whereYear('order_date', $lastMonth->year)->count();
        $ordersGrowth = $lastMonthOrders > 0 ? (($totalOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : 0;

        // Today Orders
        $todayOrders = Order::whereDate('order_date', $today)->count();

        // Total Revenue bulan ini dengan perbandingan
        $monthRevenue = Order::where('status', '!=', 'canceled')
            ->whereBetween('order_date', [$startOfMonth, $endOfMonth])
            ->sum('total_price');

        $lastMonthRevenue = Order::where('status', '!=', 'canceled')->whereMonth('order_date', $lastMonth->month)->whereYear('order_date', $lastMonth->year)->sum('total_price');

        $revenueGrowth = $lastMonthRevenue > 0 ? (($monthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // Total Customers dengan pertumbuhan
        $totalCustomers = Customer::count();
        $lastMonthCustomers = Customer::whereMonth('created_at', $lastMonth->month)->whereYear('created_at', $lastMonth->year)->count();
        $customersGrowth = $lastMonthCustomers > 0 ? (($totalCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 : 0;

        // Active Menus
        $activeMenus = Menu::where('is_active', true)->count();
        $totalMenus = Menu::count();

        // ========== CHART: REVENUE VS EXPENSES (6 Bulan) ==========
        $revenueExpensesData = $this->getRevenueExpensesChart();

        // ========== CHART: ORDER STATUS DISTRIBUTION ==========
        $orderStatusData = Order::select('status', DB::raw('count(*) as total'))->groupBy('status')->get()->pluck('total', 'status')->toArray();

        // ========== CHART: TOP SELLING MENUS ==========
        $topMenus = OrderItem::select('menu_id', DB::raw('SUM(qty) as total_qty'))->with('menu')->groupBy('menu_id')->orderByDesc('total_qty')->limit(5)->get();

        // ========== CHART: MONTHLY SALES TREND (6 Bulan) ==========
        $monthlySales = $this->getMonthlySalesChart();

        // ========== RECENT ORDERS ==========
        $latestOrders = Order::with('customer')->latest()->limit(5)->get();

        // ========== CASH FLOW SUMMARY ==========
        $totalIncome = Income::whereBetween('income_date', [$startOfMonth, $endOfMonth])->sum('total_amount');

        $totalExpense = Expense::whereBetween('expense_date', [$startOfMonth, $endOfMonth])->sum('total_amount');

        $netProfit = $monthRevenue + $totalIncome - $totalExpense;

        return view('dashboard', compact('totalOrders', 'ordersGrowth', 'todayOrders', 'monthRevenue', 'revenueGrowth', 'totalCustomers', 'customersGrowth', 'activeMenus', 'totalMenus', 'revenueExpensesData', 'orderStatusData', 'topMenus', 'monthlySales', 'latestOrders', 'totalIncome', 'totalExpense', 'netProfit'));
    }

    /**
     * Get Revenue vs Expenses data untuk 6 bulan terakhir
     */
    private function getRevenueExpensesChart()
    {
        $months = [];
        $revenues = [];
        $expenses = [];
        $incomes = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->locale('id')->isoFormat('MMM YYYY');

            $months[] = $monthName;

            // Revenue dari orders
            $revenue = Order::where('status', '!=', 'canceled')->whereMonth('order_date', $date->month)->whereYear('order_date', $date->year)->sum('total_price');

            $revenues[] = $revenue;

            // Expenses
            $expense = Expense::whereMonth('expense_date', $date->month)->whereYear('expense_date', $date->year)->sum('total_amount');

            $expenses[] = $expense;

            // Incomes (selain dari orders)
            $income = Income::whereMonth('income_date', $date->month)->whereYear('income_date', $date->year)->sum('total_amount');

            $incomes[] = $income;
        }

        return [
            'months' => $months,
            'revenues' => $revenues,
            'expenses' => $expenses,
            'incomes' => $incomes,
        ];
    }

    /**
     * Get Monthly Sales untuk 6 bulan terakhir
     */
    private function getMonthlySalesChart()
    {
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $sales = Order::where('status', '!=', 'canceled')->whereMonth('order_date', $date->month)->whereYear('order_date', $date->year)->sum('total_price');

            $data[] = [
                'month' => $date->locale('id')->isoFormat('MMM'),
                'year' => $date->year,
                'sales' => $sales,
            ];
        }

        return $data;
    }
}
