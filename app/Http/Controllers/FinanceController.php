<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        // Default: bulan ini
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // 1. Revenue dari Orders (hanya yang delivered)
        $ordersRevenue = Order::where('status', 'delivered')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->sum('total_price');

        // 2. Pemasukan Lain (UPDATE: gunakan total_amount)
        $otherIncome = Income::whereBetween('income_date', [$startDate, $endDate])->sum('total_amount'); // CHANGED from 'amount'

        // 3. Total Revenue
        $totalRevenue = $ordersRevenue + $otherIncome;

        // 4. Total Expenses (UPDATE: gunakan total_amount)
        $totalExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->sum('total_amount'); // CHANGED from 'amount'

        // 5. Profit/Loss
        $profit = $totalRevenue - $totalExpenses;

        // 6. Recent Transactions (5 terbaru)
        $recentExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->latest('expense_date')
            ->take(5)
            ->get();

        $recentIncomes = Income::whereBetween('income_date', [$startDate, $endDate])
            ->latest('income_date')
            ->take(5)
            ->get();

        return view('finance.index', compact('ordersRevenue', 'otherIncome', 'totalRevenue', 'totalExpenses', 'profit', 'recentExpenses', 'recentIncomes', 'startDate', 'endDate'));
    }

    public function sales(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $sales = Order::with('customer')
            ->where('status', 'delivered')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->latest('order_date')
            ->paginate(15);

        $totalSales = Order::where('status', 'delivered')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->sum('total_price');

        return view('finance.sales', compact('sales', 'totalSales', 'startDate', 'endDate'));
    }
}
