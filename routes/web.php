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

require __DIR__ . '/auth.php';
