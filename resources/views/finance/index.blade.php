<x-app-layout>
    @section('page-title', 'Keuangan - Dashboard')

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Tabs Navigation --}}
            <div class="mb-6">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8 overflow-x-auto">
                        <a href="{{ route('finance.index') }}"
                            class="border-indigo-500 text-indigo-600 dark:text-indigo-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fas fa-chart-line mr-2"></i>Dashboard
                        </a>

                        <a href="{{ route('finance.expenses.index') }}"
                            class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fas fa-minus-circle mr-2"></i>Pengeluaran
                        </a>

                        <a href="{{ route('finance.incomes.index') }}"
                            class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fas fa-plus-circle mr-2"></i>Pemasukan Lain
                        </a>

                        <a href="{{ route('finance.sales') }}"
                            class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fas fa-shopping-cart mr-2"></i>Penjualan Orders
                        </a>
                    </nav>
                </div>
            </div>

            {{-- Filter Periode --}}
            <div class="mb-6 bg-white dark:bg-gray-900 rounded-lg shadow-sm p-4">
                <form method="GET" action="{{ route('finance.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Dari Tanggal
                        </label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sampai Tanggal
                        </label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    </div>

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                        Filter
                    </button>

                    <a href="{{ route('finance.index') }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg transition">
                        Reset
                    </a>
                </form>
            </div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                {{-- Total Pemasukan --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pemasukan</h3>
                        <div
                            class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Orders: Rp {{ number_format($ordersRevenue, 0, ',', '.') }}<br>
                        Lainnya: Rp {{ number_format($otherIncome, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Total Pengeluaran --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
                        <div
                            class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($totalExpenses, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Laba/Rugi --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Laba/Rugi</h3>
                        <div
                            class="w-10 h-10 {{ $profit >= 0 ? 'bg-blue-100 dark:bg-blue-900/30' : 'bg-red-100 dark:bg-red-900/30' }} rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 {{ $profit >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <p
                        class="text-2xl font-bold {{ $profit >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        Rp {{ number_format($profit, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Profit Margin --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Profit Margin</h3>
                        <div
                            class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $totalRevenue > 0 ? number_format(($profit / $totalRevenue) * 100, 1) : 0 }}%
                    </p>
                </div>
            </div>

            {{-- Recent Transactions --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Recent Expenses --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengeluaran Terbaru</h3>
                        <a href="{{ route('finance.expenses.index') }}"
                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">
                            Lihat Semua →
                        </a>
                    </div>

                    @if ($recentExpenses->count() > 0)
                        <div class="space-y-3">
                            @foreach ($recentExpenses as $expense)
                                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $expense->expense_date->format('d M Y') }}
                                        </span>
                                        <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                            -Rp {{ number_format($expense->total_amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        @foreach ($expense->items as $item)
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                                    {{ $item['category'] }}
                                                </span>
                                                <span class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                                    {{ $item['description'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">Tidak ada pengeluaran</p>
                    @endif
                </div>

                {{-- Recent Incomes --}}
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pemasukan Lain Terbaru</h3>
                        <a href="{{ route('finance.incomes.index') }}"
                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">
                            Lihat Semua →
                        </a>
                    </div>

                    @if ($recentIncomes->count() > 0)
                        <div class="space-y-3">
                            @foreach ($recentIncomes as $income)
                                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $income->income_date->format('d M Y') }}
                                        </span>
                                        <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                            +Rp {{ number_format($income->total_amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        @foreach ($income->items as $item)
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                                    {{ $item['source'] }}
                                                </span>
                                                <span class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                                    {{ $item['description'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">Tidak ada pemasukan lain</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
