<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('menus', MenuController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
    Route::resource('customers', CustomerController::class);

    // Finance Routes
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('/finance/sales', [FinanceController::class, 'sales'])->name('finance.sales');
    Route::resource('finance/expenses', ExpenseController::class)->names([
        'index' => 'finance.expenses.index',
        'create' => 'finance.expenses.create',
        'store' => 'finance.expenses.store',
        'show' => 'finance.expenses.show',
        'edit' => 'finance.expenses.edit',
        'update' => 'finance.expenses.update',
        'destroy' => 'finance.expenses.destroy',
    ]);
    Route::resource('finance/incomes', IncomeController::class)->names([
        'index' => 'finance.incomes.index',
        'create' => 'finance.incomes.create',
        'store' => 'finance.incomes.store',
        'show' => 'finance.incomes.show',
        'edit' => 'finance.incomes.edit',
        'update' => 'finance.incomes.update',
        'destroy' => 'finance.incomes.destroy',
    ]);
});

// Reports Routes
Route::middleware(['auth', 'admin', 'verified'])
    ->prefix('reports')
    ->name('reports.')
    ->group(function () {
        // Dashboard
        Route::get('/', [App\Http\Controllers\Reports\ReportController::class, 'index'])->name('index');

        // Orders Reports
        Route::get('/orders', [App\Http\Controllers\Reports\ReportController::class, 'orders'])->name('orders');
        Route::get('/orders/excel', [App\Http\Controllers\Reports\ReportController::class, 'ordersExcel'])->name('orders.excel');
        Route::get('/orders/pdf', [App\Http\Controllers\Reports\ReportController::class, 'ordersPdf'])->name('orders.pdf');

        Route::get('/sales-by-menu', [App\Http\Controllers\Reports\ReportController::class, 'salesByMenu'])->name('sales-by-menu');
        Route::get('/sales-by-menu/excel', [App\Http\Controllers\Reports\ReportController::class, 'salesByMenuExcel'])->name('sales-by-menu.excel');
        Route::get('/sales-by-menu/pdf', [App\Http\Controllers\Reports\ReportController::class, 'salesByMenuPdf'])->name('sales-by-menu.pdf');

        Route::get('/sales-by-customer', [App\Http\Controllers\Reports\ReportController::class, 'salesByCustomer'])->name('sales-by-customer');
        Route::get('/sales-by-customer/excel', [App\Http\Controllers\Reports\ReportController::class, 'salesByCustomerExcel'])->name('sales-by-customer.excel');
        Route::get('/sales-by-customer/pdf', [App\Http\Controllers\Reports\ReportController::class, 'salesByCustomerPdf'])->name('sales-by-customer.pdf');

        // Finance Reports
        Route::get('/profit-loss', [App\Http\Controllers\Reports\ReportController::class, 'profitLoss'])->name('profit-loss');
        Route::get('/profit-loss/excel', [App\Http\Controllers\Reports\ReportController::class, 'profitLossExcel'])->name('profit-loss.excel');
        Route::get('/profit-loss/pdf', [App\Http\Controllers\Reports\ReportController::class, 'profitLossPdf'])->name('profit-loss.pdf');

        Route::get('/expenses', [App\Http\Controllers\Reports\ReportController::class, 'expenses'])->name('expenses');
        Route::get('/expenses/excel', [App\Http\Controllers\Reports\ReportController::class, 'expensesExcel'])->name('expenses.excel');
        Route::get('/expenses/pdf', [App\Http\Controllers\Reports\ReportController::class, 'expensesPdf'])->name('expenses.pdf');

        Route::get('/incomes', [App\Http\Controllers\Reports\ReportController::class, 'incomes'])->name('incomes');
        Route::get('/incomes/excel', [App\Http\Controllers\Reports\ReportController::class, 'incomesExcel'])->name('incomes.excel');
        Route::get('/incomes/pdf', [App\Http\Controllers\Reports\ReportController::class, 'incomesPdf'])->name('incomes.pdf');

        // Master Data Reports
        Route::get('/menus', [App\Http\Controllers\Reports\ReportController::class, 'menus'])->name('menus');
        Route::get('/menus/excel', [App\Http\Controllers\Reports\ReportController::class, 'menusExcel'])->name('menus.excel');
        Route::get('/menus/pdf', [App\Http\Controllers\Reports\ReportController::class, 'menusPdf'])->name('menus.pdf');

        Route::get('/customers', [App\Http\Controllers\Reports\ReportController::class, 'customers'])->name('customers');
        Route::get('/customers/excel', [App\Http\Controllers\Reports\ReportController::class, 'customersExcel'])->name('customers.excel');
        Route::get('/customers/pdf', [App\Http\Controllers\Reports\ReportController::class, 'customersPdf'])->name('customers.pdf');

        Route::get('/categories', [App\Http\Controllers\Reports\ReportController::class, 'categories'])->name('categories');
        Route::get('/categories/excel', [App\Http\Controllers\Reports\ReportController::class, 'categoriesExcel'])->name('categories.excel');
        Route::get('/categories/pdf', [App\Http\Controllers\Reports\ReportController::class, 'categoriesPdf'])->name('categories.pdf');
    });

require __DIR__ . '/auth.php';
