<x-app-layout>
    @section('page-title', 'Dashboard')

    {{-- ApexCharts CDN --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.45.1/dist/apexcharts.min.css">
    @endpush

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8 space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    Dashboard Admin
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                    Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan bisnis Anda.
                </p>
            </div>

            {{-- Quick Actions --}}
            <div class="flex gap-2">
                <a href="{{ route('orders.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white rounded-lg transition-all duration-200 shadow-lg shadow-indigo-500/30 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Order Baru
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

            {{-- Total Orders --}}
            <div
                class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-xl dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:-translate-y-1 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    @if ($ordersGrowth != 0)
                        <span
                            class="text-xs font-semibold {{ $ordersGrowth > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center gap-1">
                            @if ($ordersGrowth > 0)
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            @endif
                            {{ number_format(abs($ordersGrowth), 1) }}%
                        </span>
                    @endif
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Order</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ number_format($totalOrders) }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $todayOrders }}</span> order hari
                    ini
                </p>
            </div>

            {{-- Monthly Revenue --}}
            <div
                class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-xl dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:-translate-y-1 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    @if ($revenueGrowth != 0)
                        <span
                            class="text-xs font-semibold {{ $revenueGrowth > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center gap-1">
                            @if ($revenueGrowth > 0)
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            @endif
                            {{ number_format(abs($revenueGrowth), 1) }}%
                        </span>
                    @endif
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Revenue Bulan Ini</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    Rp {{ number_format($monthRevenue, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">dari penjualan catering</p>
            </div>

            {{-- Total Customers --}}
            <div
                class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-xl dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:-translate-y-1 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 110-8 4 4 0 010 8zm8 4a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    @if ($customersGrowth != 0)
                        <span
                            class="text-xs font-semibold {{ $customersGrowth > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center gap-1">
                            @if ($customersGrowth > 0)
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            @endif
                            {{ number_format(abs($customersGrowth), 1) }}%
                        </span>
                    @endif
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Pelanggan</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ number_format($totalCustomers) }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">pelanggan terdaftar</p>
            </div>

            {{-- Net Profit --}}
            <div
                class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-xl dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:-translate-y-1 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-full">
                        Bulan Ini
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Net Profit</p>
                <p
                    class="text-2xl md:text-3xl font-bold {{ $netProfit >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} mb-2">
                    Rp {{ number_format(abs($netProfit), 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    Revenue + Income - Expense
                </p>
            </div>

        </div>

        {{-- Charts Row 1: Revenue vs Expenses & Order Status --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Revenue vs Expenses Chart --}}
            <div
                class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Tren Keuangan</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Revenue, Income & Expenses 6 bulan
                            terakhir</p>
                    </div>
                </div>

                @php
                    $hasRevenueData =
                        collect($revenueExpensesData['revenues'])->sum() > 0 ||
                        collect($revenueExpensesData['expenses'])->sum() > 0 ||
                        collect($revenueExpensesData['incomes'])->sum() > 0;
                @endphp

                @if ($hasRevenueData)
                    <div id="revenueExpensesChart"></div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <svg class="w-20 h-20 text-gray-300 dark:text-gray-700 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">Belum Ada Data Keuangan</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm text-center">Data transaksi keuangan akan
                            ditampilkan di sini</p>
                        <a href="{{ route('finance.index') }}"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-900/50 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Kelola Keuangan
                        </a>
                    </div>
                @endif
            </div>

            {{-- Order Status Distribution --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Status Order</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Distribusi status order saat ini</p>
                </div>

                @if (count($orderStatusData) > 0)
                    <div id="orderStatusChart"></div>
                @else
                    <div class="flex flex-col items-center justify-center py-8">
                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-700 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">Belum Ada Order</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm text-center">Status order akan ditampilkan
                            di sini</p>
                        <a href="{{ route('orders.create') }}"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Order
                        </a>
                    </div>
                @endif
            </div>

        </div>

        {{-- Charts Row 2: Monthly Sales & Top Menus --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Monthly Sales Trend --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Tren Penjualan</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Penjualan bulanan 6 bulan terakhir
                        </p>
                    </div>
                </div>

                @php
                    $hasSalesData = collect($monthlySales)->sum('sales') > 0;
                @endphp

                @if ($hasSalesData)
                    <div id="monthlySalesChart"></div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <svg class="w-20 h-20 text-gray-300 dark:text-gray-700 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">Belum Ada Data Penjualan</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm text-center">Tren penjualan akan ditampilkan
                            di sini<br />setelah ada transaksi</p>
                    </div>
                @endif
            </div>

            {{-- Top Selling Menus --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Menu Terlaris</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Top 5 menu dengan penjualan
                            tertinggi</p>
                    </div>
                </div>

                @if ($topMenus->count() > 0)
                    <div id="topMenusChart"></div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <svg class="w-20 h-20 text-gray-300 dark:text-gray-700 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">Belum Ada Data Menu</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm text-center">Menu terlaris akan ditampilkan
                            di sini<br />setelah ada penjualan</p>
                        <a href="{{ route('menus.index') }}"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-lg hover:bg-purple-200 dark:hover:bg-purple-900/50 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Menu
                        </a>
                    </div>
                @endif
            </div>

        </div>

        {{-- Recent Orders Table --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Terbaru</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">5 transaksi terakhir dari pelanggan</p>
                </div>
                <a href="{{ route('orders.index') }}"
                    class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors duration-200 text-sm font-medium">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Customer</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">
                                Status</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($latestOrders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $order->customer->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden">
                                                {{ ucfirst($order->status) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center hidden sm:table-cell">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400' : '' }}
                                        {{ $order->status === 'confirmed' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : '' }}
                                        {{ $order->status === 'cooking' ? 'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-400' : '' }}
                                        {{ $order->status === 'ready' ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400' : '' }}
                                        {{ $order->status === 'delivered' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : '' }}
                                        {{ $order->status === 'canceled' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center hidden md:table-cell">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-600 dark:text-gray-400 font-medium">Belum ada order</p>
                                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Order dari pelanggan
                                            akan muncul di sini</p>
                                        <a href="{{ route('orders.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg transition-colors text-sm font-medium">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Buat Order Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- ApexCharts Scripts --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.1/dist/apexcharts.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const isDark = document.documentElement.classList.contains('dark');

                // ========== REVENUE VS EXPENSES CHART ==========
                @php
                    $hasRevenueData = collect($revenueExpensesData['revenues'])->sum() > 0 || collect($revenueExpensesData['expenses'])->sum() > 0 || collect($revenueExpensesData['incomes'])->sum() > 0;
                @endphp

                @if ($hasRevenueData)
                    const revenueExpensesOptions = {
                        series: [{
                            name: 'Revenue',
                            data: @json($revenueExpensesData['revenues'])
                        }, {
                            name: 'Income',
                            data: @json($revenueExpensesData['incomes'])
                        }, {
                            name: 'Expenses',
                            data: @json($revenueExpensesData['expenses'])
                        }],
                        chart: {
                            type: 'area',
                            height: 350,
                            toolbar: {
                                show: false
                            },
                            fontFamily: 'inherit',
                        },
                        colors: ['#8B5CF6', '#10B981', '#EF4444'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                opacityFrom: 0.6,
                                opacityTo: 0.1,
                            }
                        },
                        xaxis: {
                            categories: @json($revenueExpensesData['months']),
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                },
                                formatter: function(val) {
                                    return 'Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            labels: {
                                colors: isDark ? '#E5E7EB' : '#374151'
                            }
                        },
                        grid: {
                            borderColor: isDark ? '#374151' : '#E5E7EB',
                            strokeDashArray: 4,
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: function(val) {
                                    return 'Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    };
                    const revenueExpensesChart = new ApexCharts(document.querySelector("#revenueExpensesChart"),
                        revenueExpensesOptions);
                    revenueExpensesChart.render();
                @endif

                // ========== ORDER STATUS CHART ==========
                @if (count($orderStatusData) > 0)
                    const orderStatusData = @json($orderStatusData);
                    const statusLabels = Object.keys(orderStatusData).map(status => {
                        const labels = {
                            pending: 'Pending',
                            confirmed: 'Confirmed',
                            cooking: 'Cooking',
                            ready: 'Ready',
                            delivered: 'Delivered',
                            canceled: 'Canceled'
                        };
                        return labels[status] || status;
                    });
                    const statusValues = Object.values(orderStatusData);

                    const orderStatusOptions = {
                        series: statusValues,
                        chart: {
                            type: 'donut',
                            height: 320,
                            fontFamily: 'inherit',
                        },
                        labels: statusLabels,
                        colors: ['#FBBF24', '#3B82F6', '#F97316', '#A855F7', '#10B981', '#EF4444'],
                        legend: {
                            position: 'bottom',
                            labels: {
                                colors: isDark ? '#E5E7EB' : '#374151'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '12px',
                                fontWeight: 600
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '70%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total Orders',
                                            fontSize: '14px',
                                            color: isDark ? '#9CA3AF' : '#6B7280',
                                            formatter: function(w) {
                                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                            }
                                        },
                                        value: {
                                            fontSize: '22px',
                                            fontWeight: 700,
                                            color: isDark ? '#E5E7EB' : '#111827'
                                        }
                                    }
                                }
                            }
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: function(val) {
                                    return val + ' orders';
                                }
                            }
                        }
                    };
                    const orderStatusChart = new ApexCharts(document.querySelector("#orderStatusChart"),
                        orderStatusOptions);
                    orderStatusChart.render();
                @endif

                // ========== MONTHLY SALES CHART ==========
                @php
                    $hasSalesData = collect($monthlySales)->sum('sales') > 0;
                @endphp

                @if ($hasSalesData)
                    const monthlySalesData = @json($monthlySales);
                    const monthlySalesOptions = {
                        series: [{
                            name: 'Penjualan',
                            data: monthlySalesData.map(item => item.sales)
                        }],
                        chart: {
                            type: 'line',
                            height: 320,
                            toolbar: {
                                show: false
                            },
                            fontFamily: 'inherit',
                        },
                        colors: ['#6366F1'],
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        markers: {
                            size: 5,
                            colors: ['#6366F1'],
                            strokeColors: '#fff',
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        },
                        xaxis: {
                            categories: monthlySalesData.map(item => item.month),
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                },
                                formatter: function(val) {
                                    if (val >= 1000000) {
                                        return 'Rp ' + (val / 1000000).toFixed(1) + 'jt';
                                    } else if (val >= 1000) {
                                        return 'Rp ' + (val / 1000).toFixed(0) + 'rb';
                                    }
                                    return 'Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        },
                        grid: {
                            borderColor: isDark ? '#374151' : '#E5E7EB',
                            strokeDashArray: 4,
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: function(val) {
                                    return 'Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    };
                    const monthlySalesChart = new ApexCharts(document.querySelector("#monthlySalesChart"),
                        monthlySalesOptions);
                    monthlySalesChart.render();
                @endif

                // ========== TOP MENUS CHART ==========
                @if ($topMenus->count() > 0)
                    const topMenusData = @json($topMenus);
                    const menuNames = topMenusData.map(item => item.menu ? item.menu.name : 'Unknown');
                    const menuQty = topMenusData.map(item => item.total_qty);

                    const topMenusOptions = {
                        series: [{
                            name: 'Terjual',
                            data: menuQty
                        }],
                        chart: {
                            type: 'bar',
                            height: 320,
                            toolbar: {
                                show: false
                            },
                            fontFamily: 'inherit',
                        },
                        colors: ['#8B5CF6'],
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 6,
                                dataLabels: {
                                    position: 'top'
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            offsetX: 30,
                            style: {
                                fontSize: '12px',
                                colors: [isDark ? '#E5E7EB' : '#111827']
                            },
                            formatter: function(val) {
                                return val + ' porsi';
                            }
                        },
                        xaxis: {
                            categories: menuNames,
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        },
                        grid: {
                            borderColor: isDark ? '#374051' : '#E5E7EB',
                            strokeDashArray: 4,
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: function(val) {
                                    return val + ' porsi terjual';
                                }
                            }
                        }
                    };
                    const topMenusChart = new ApexCharts(document.querySelector("#topMenusChart"), topMenusOptions);
                    topMenusChart.render();
                @endif
            });
        </script>
    @endpush
</x-app-layout>
