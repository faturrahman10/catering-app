<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Exports\SalesByMenuExport;
use App\Exports\SalesByCustomerExport;
use App\Exports\ProfitLossExport;
use App\Exports\ExpensesExport;
use App\Exports\IncomesExport;
use App\Exports\MenusExport;
use App\Exports\CustomersExport;
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Dashboard Laporan
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * ============================================
     * LAPORAN PENJUALAN - ORDERS
     * ============================================
     */
    public function orders(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $status = $request->input('status', 'all');
        $customerId = $request->input('customer_id');

        $query = Order::with(['customer', 'items.menu'])->whereBetween('order_date', [$startDate, $endDate]);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($customerId) {
            $query->where('customer_id', $customerId);
        }

        $orders = $query->latest('order_date')->get();
        $customers = Customer::orderBy('name')->get();

        $totalOrders = $orders->count();
        $totalAmount = $orders->sum('total_price');

        return view('reports.orders.index', compact('orders', 'customers', 'startDate', 'endDate', 'status', 'customerId', 'totalOrders', 'totalAmount'));
    }

    public function ordersExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $status = $request->input('status', 'all');
        $customerId = $request->input('customer_id');

        $fileName = 'Laporan_Order_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new OrdersExport($startDate, $endDate, $status, $customerId), $fileName);
    }

    public function ordersPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $status = $request->input('status', 'all');
        $customerId = $request->input('customer_id');

        $query = Order::with(['customer', 'items.menu'])->whereBetween('order_date', [$startDate, $endDate]);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($customerId) {
            $query->where('customer_id', $customerId);
        }

        $orders = $query->latest('order_date')->get();
        $totalOrders = $orders->count();
        $totalAmount = $orders->sum('total_price');

        $pdf = Pdf::loadView('reports.pdf.orders', compact('orders', 'startDate', 'endDate', 'status', 'totalOrders', 'totalAmount'));

        $fileName = 'Laporan_Order_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN PENJUALAN - SALES BY MENU
     * ============================================
     */
    public function salesByMenu(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $categoryId = $request->input('category_id');

        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->where('orders.status', 'delivered')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->select('menus.id', 'menus.name as menu_name', 'categories.name as category_name', 'menus.price', DB::raw('SUM(order_items.qty) as total_qty'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->groupBy('menus.id', 'menus.name', 'categories.name', 'menus.price');

        if ($categoryId) {
            $query->where('menus.category_id', $categoryId);
        }

        $salesByMenu = $query->orderByDesc('total_revenue')->get();
        $categories = Category::orderBy('name')->get();

        $totalRevenue = $salesByMenu->sum('total_revenue');

        // Calculate percentage
        $salesByMenu = $salesByMenu->map(function ($item) use ($totalRevenue) {
            $item->percentage = $totalRevenue > 0 ? ($item->total_revenue / $totalRevenue) * 100 : 0;
            return $item;
        });

        return view('reports.orders.sales-by-menu', compact('salesByMenu', 'categories', 'startDate', 'endDate', 'categoryId', 'totalRevenue'));
    }

    public function salesByMenuExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $categoryId = $request->input('category_id');

        $fileName = 'Laporan_Penjualan_per_Menu_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new SalesByMenuExport($startDate, $endDate, $categoryId), $fileName);
    }

    public function salesByMenuPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $categoryId = $request->input('category_id');

        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->where('orders.status', 'delivered')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->select('menus.name as menu_name', 'categories.name as category_name', 'menus.price', DB::raw('SUM(order_items.qty) as total_qty'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->groupBy('menus.name', 'categories.name', 'menus.price');

        if ($categoryId) {
            $query->where('menus.category_id', $categoryId);
        }

        $salesByMenu = $query->orderByDesc('total_revenue')->get();
        $totalRevenue = $salesByMenu->sum('total_revenue');

        $salesByMenu = $salesByMenu->map(function ($item) use ($totalRevenue) {
            $item->percentage = $totalRevenue > 0 ? ($item->total_revenue / $totalRevenue) * 100 : 0;
            return $item;
        });

        $pdf = Pdf::loadView('reports.pdf.sales-by-menu', compact('salesByMenu', 'startDate', 'endDate', 'totalRevenue'));

        $fileName = 'Laporan_Penjualan_per_Menu_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN PENJUALAN - SALES BY CUSTOMER
     * ============================================
     */
    public function salesByCustomer(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesByCustomer = Customer::withCount([
            'orders as total_orders' => function ($query) use ($startDate, $endDate) {
                $query->where('status', 'delivered')->whereBetween('order_date', [$startDate, $endDate]);
            },
        ])
            ->withSum(
                [
                    'orders as total_spent' => function ($query) use ($startDate, $endDate) {
                        $query->where('status', 'delivered')->whereBetween('order_date', [$startDate, $endDate]);
                    },
                ],
                'total_price',
            )
            ->with([
                'orders' => function ($query) use ($startDate, $endDate) {
                    $query
                        ->where('status', 'delivered')
                        ->whereBetween('order_date', [$startDate, $endDate])
                        ->latest('order_date')
                        ->limit(1);
                },
            ])
            ->orderByDesc('total_spent')
            ->get();

        // Add last order date and active status
        $salesByCustomer = $salesByCustomer->map(function ($customer) {
            $customer->last_order_date = $customer->orders->first()?->order_date;
            $customer->is_active = $customer->last_order_date && $customer->last_order_date->isAfter(now()->subDays(30));
            return $customer;
        });

        $totalRevenue = $salesByCustomer->sum('total_spent');

        return view('reports.orders.sales-by-customer', compact('salesByCustomer', 'startDate', 'endDate', 'totalRevenue'));
    }

    public function salesByCustomerExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $fileName = 'Laporan_Penjualan_per_Customer_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new SalesByCustomerExport($startDate, $endDate), $fileName);
    }

    public function salesByCustomerPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesByCustomer = Customer::withCount([
            'orders as total_orders' => function ($query) use ($startDate, $endDate) {
                $query->where('status', 'delivered')->whereBetween('order_date', [$startDate, $endDate]);
            },
        ])
            ->withSum(
                [
                    'orders as total_spent' => function ($query) use ($startDate, $endDate) {
                        $query->where('status', 'delivered')->whereBetween('order_date', [$startDate, $endDate]);
                    },
                ],
                'total_price',
            )
            ->with([
                'orders' => function ($query) use ($startDate, $endDate) {
                    $query
                        ->where('status', 'delivered')
                        ->whereBetween('order_date', [$startDate, $endDate])
                        ->latest('order_date')
                        ->limit(1);
                },
            ])
            ->orderByDesc('total_spent')
            ->get();

        $salesByCustomer = $salesByCustomer->map(function ($customer) {
            $customer->last_order_date = $customer->orders->first()?->order_date;
            $customer->is_active = $customer->last_order_date && $customer->last_order_date->isAfter(now()->subDays(30));
            return $customer;
        });

        $totalRevenue = $salesByCustomer->sum('total_spent');

        $pdf = Pdf::loadView('reports.pdf.sales-by-customer', compact('salesByCustomer', 'startDate', 'endDate', 'totalRevenue'));

        $fileName = 'Laporan_Penjualan_per_Customer_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN KEUANGAN - PROFIT LOSS
     * ============================================
     */
    public function profitLoss(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Revenue from delivered orders
        $ordersRevenue = Order::where('status', 'delivered')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->sum('total_price');

        // Other income
        $otherIncome = Income::whereBetween('income_date', [$startDate, $endDate])->sum('total_amount');

        $totalRevenue = $ordersRevenue + $otherIncome;

        // Expenses by category
        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->get();

        $expensesByCategory = [];
        $totalExpenses = 0;

        foreach ($expenses as $expense) {
            foreach ($expense->items as $item) {
                $category = $item['category'];
                if (!isset($expensesByCategory[$category])) {
                    $expensesByCategory[$category] = [
                        'category' => $category,
                        'total' => 0,
                        'items' => [],
                    ];
                }
                $expensesByCategory[$category]['total'] += $item['amount'];
                $expensesByCategory[$category]['items'][] = $item;
                $totalExpenses += $item['amount'];
            }
        }

        $profit = $totalRevenue - $totalExpenses;

        return view('reports.finance.profit-loss', compact('startDate', 'endDate', 'ordersRevenue', 'otherIncome', 'totalRevenue', 'expensesByCategory', 'totalExpenses', 'profit'));
    }

    public function profitLossExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $fileName = 'Laporan_Laba_Rugi_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new ProfitLossExport($startDate, $endDate), $fileName);
    }

    public function profitLossPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $ordersRevenue = Order::where('status', 'delivered')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->sum('total_price');

        $otherIncome = Income::whereBetween('income_date', [$startDate, $endDate])->sum('total_amount');

        $totalRevenue = $ordersRevenue + $otherIncome;

        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->get();

        $expensesByCategory = [];
        $totalExpenses = 0;

        foreach ($expenses as $expense) {
            foreach ($expense->items as $item) {
                $category = $item['category'];
                if (!isset($expensesByCategory[$category])) {
                    $expensesByCategory[$category] = [
                        'category' => $category,
                        'total' => 0,
                    ];
                }
                $expensesByCategory[$category]['total'] += $item['amount'];
                $totalExpenses += $item['amount'];
            }
        }

        $profit = $totalRevenue - $totalExpenses;

        $pdf = Pdf::loadView('reports.pdf.profit-loss', compact('startDate', 'endDate', 'ordersRevenue', 'otherIncome', 'totalRevenue', 'expensesByCategory', 'totalExpenses', 'profit'));

        $fileName = 'Laporan_Laba_Rugi_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN KEUANGAN - EXPENSES
     * ============================================
     */
    public function expenses(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $category = $request->input('category');

        $query = Expense::with('creator')->whereBetween('expense_date', [$startDate, $endDate]);

        // Filter by category in items JSON
        if ($category) {
            $query->whereJsonContains('items', [['category' => $category]]);
        }

        $expenses = $query->latest('expense_date')->get();

        // Get unique categories for filter
        $categories = ['Bahan Makanan', 'Alat Dapur', 'Gaji Karyawan', 'Utilitas (Listrik, Air, Gas)', 'Transportasi', 'Sewa Tempat', 'Lainnya'];

        $totalExpenses = $expenses->sum('total_amount');

        return view('reports.finance.expenses', compact('expenses', 'categories', 'startDate', 'endDate', 'category', 'totalExpenses'));
    }

    public function expensesExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $category = $request->input('category');

        $fileName = 'Laporan_Pengeluaran_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new ExpensesExport($startDate, $endDate, $category), $fileName);
    }

    public function expensesPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $category = $request->input('category');

        $query = Expense::with('creator')->whereBetween('expense_date', [$startDate, $endDate]);

        if ($category) {
            $query->whereJsonContains('items', [['category' => $category]]);
        }

        $expenses = $query->latest('expense_date')->get();
        $totalExpenses = $expenses->sum('total_amount');

        $pdf = Pdf::loadView('reports.pdf.expenses', compact('expenses', 'startDate', 'endDate', 'category', 'totalExpenses'));

        $fileName = 'Laporan_Pengeluaran_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN KEUANGAN - INCOMES
     * ============================================
     */
    public function incomes(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $incomes = Income::with('creator')
            ->whereBetween('income_date', [$startDate, $endDate])
            ->latest('income_date')
            ->get();

        $totalIncomes = $incomes->sum('total_amount');

        return view('reports.finance.incomes', compact('incomes', 'startDate', 'endDate', 'totalIncomes'));
    }

    public function incomesExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $fileName = 'Laporan_Pemasukan_Lain_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new IncomesExport($startDate, $endDate), $fileName);
    }

    public function incomesPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $incomes = Income::with('creator')
            ->whereBetween('income_date', [$startDate, $endDate])
            ->latest('income_date')
            ->get();

        $totalIncomes = $incomes->sum('total_amount');

        $pdf = Pdf::loadView('reports.pdf.incomes', compact('incomes', 'startDate', 'endDate', 'totalIncomes'));

        $fileName = 'Laporan_Pemasukan_Lain_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN DATA MASTER - MENUS
     * ============================================
     */
    public function menus(Request $request)
    {
        $status = $request->input('status', 'all');
        $categoryId = $request->input('category_id');

        $query = Menu::with('category');

        if ($status !== 'all') {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Add total sold count
        $menus = $query
            ->withCount([
                'orderItems as total_sold' => function ($query) {
                    $query->join('orders', 'order_items.order_id', '=', 'orders.id')->where('orders.status', 'delivered')->select(DB::raw('SUM(order_items.qty)'));
                },
            ])
            ->orderBy('name')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('reports.master.menus', compact('menus', 'categories', 'status', 'categoryId'));
    }

    public function menusExcel(Request $request)
    {
        $status = $request->input('status', 'all');
        $categoryId = $request->input('category_id');

        $fileName = 'Laporan_Menu_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new MenusExport($status, $categoryId), $fileName);
    }

    public function menusPdf(Request $request)
    {
        $status = $request->input('status', 'all');
        $categoryId = $request->input('category_id');

        $query = Menu::with('category');

        if ($status !== 'all') {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $menus = $query
            ->withCount([
                'orderItems as total_sold' => function ($query) {
                    $query->join('orders', 'order_items.order_id', '=', 'orders.id')->where('orders.status', 'delivered')->select(DB::raw('SUM(order_items.qty)'));
                },
            ])
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView('reports.pdf.menus', compact('menus', 'status'));

        $fileName = 'Laporan_Menu_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN DATA MASTER - CUSTOMERS
     * ============================================
     */
    public function customers(Request $request)
    {
        $customers = Customer::withCount([
            'orders as total_orders' => function ($query) {
                $query->where('status', 'delivered');
            },
        ])
            ->withSum(
                [
                    'orders as total_spent' => function ($query) {
                        $query->where('status', 'delivered');
                    },
                ],
                'total_price',
            )
            ->with([
                'orders' => function ($query) {
                    $query->where('status', 'delivered')->latest('order_date')->limit(1);
                },
            ])
            ->orderBy('name')
            ->get();

        // Add last order date and active status
        $customers = $customers->map(function ($customer) {
            $customer->last_order_date = $customer->orders->first()?->order_date;
            $customer->is_active = $customer->last_order_date && $customer->last_order_date->isAfter(now()->subDays(30));
            return $customer;
        });

        return view('reports.master.customers', compact('customers'));
    }

    public function customersExcel(Request $request)
    {
        $fileName = 'Laporan_Customer_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new CustomersExport(), $fileName);
    }

    public function customersPdf(Request $request)
    {
        $customers = Customer::withCount([
            'orders as total_orders' => function ($query) {
                $query->where('status', 'delivered');
            },
        ])
            ->withSum(
                [
                    'orders as total_spent' => function ($query) {
                        $query->where('status', 'delivered');
                    },
                ],
                'total_price',
            )
            ->with([
                'orders' => function ($query) {
                    $query->where('status', 'delivered')->latest('order_date')->limit(1);
                },
            ])
            ->orderBy('name')
            ->get();

        $customers = $customers->map(function ($customer) {
            $customer->last_order_date = $customer->orders->first()?->order_date;
            $customer->is_active = $customer->last_order_date && $customer->last_order_date->isAfter(now()->subDays(30));
            return $customer;
        });

        $pdf = Pdf::loadView('reports.pdf.customers', compact('customers'));

        $fileName = 'Laporan_Customer_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * ============================================
     * LAPORAN DATA MASTER - CATEGORIES
     * ============================================
     */
    public function categories(Request $request)
    {
        $status = $request->input('status', 'all');

        $query = Category::withCount('menus');

        if ($status !== 'all') {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        $categories = $query->orderBy('name')->get();

        return view('reports.master.categories', compact('categories', 'status'));
    }

    public function categoriesExcel(Request $request)
    {
        $status = $request->input('status', 'all');

        $fileName = 'Laporan_Kategori_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new CategoriesExport($status), $fileName);
    }

    public function categoriesPdf(Request $request)
    {
        $status = $request->input('status', 'all');

        $query = Category::withCount('menus');

        if ($status !== 'all') {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        $categories = $query->orderBy('name')->get();

        $pdf = Pdf::loadView('reports.pdf.categories', compact('categories', 'status'));

        $fileName = 'Laporan_Kategori_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }
}
