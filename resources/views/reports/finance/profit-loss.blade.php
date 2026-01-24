<x-app-layout>
    @section('page-title', 'Laporan Laba Rugi')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Laporan Laba Rugi
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Profit & Loss statement lengkap
                    </p>
                </div>

                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Filters --}}
        <div
            class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
            <form method="GET" action="{{ route('reports.profit-loss') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Start Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Dari Tanggal
                        </label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    </div>

                    {{-- End Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sampai Tanggal
                        </label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter
                    </button>

                    <a href="{{ route('reports.profit-loss') }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Export Buttons --}}
        <div class="mb-6 flex gap-3">
            <a href="{{ route('reports.profit-loss.excel', request()->query()) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </a>

            <a href="{{ route('reports.profit-loss.pdf', request()->query()) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Export PDF
            </a>
        </div>

        {{-- Summary Cards --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Total Revenue --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Pemasukan</p>
                        <p class="text-xl font-bold text-green-600 dark:text-green-400">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Total Expenses --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Pengeluaran</p>
                        <p class="text-xl font-bold text-red-600 dark:text-red-400">
                            Rp {{ number_format($totalExpenses, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Net Profit/Loss --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 {{ $profit >= 0 ? 'bg-blue-100 dark:bg-blue-900/30' : 'bg-orange-100 dark:bg-orange-900/30' }} rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 {{ $profit >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-orange-600 dark:text-orange-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $profit >= 0 ? 'Laba Bersih' : 'Rugi Bersih' }}</p>
                        <p
                            class="text-xl font-bold {{ $profit >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-orange-600 dark:text-orange-400' }}">
                            Rp {{ number_format(abs($profit), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Revenue Section --}}
        <div
            class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-green-100 dark:border-green-800">
                <h3 class="text-lg font-semibold text-green-900 dark:text-green-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Pemasukan
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Penjualan Orders (Delivered)</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($ordersRevenue, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Pemasukan Lain</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($otherIncome, 0, ',', '.') }}
                        </span>
                    </div>
                    <div
                        class="flex items-center justify-between py-3 bg-green-50 dark:bg-green-900/20 px-4 rounded-lg">
                        <span class="text-base font-semibold text-green-900 dark:text-green-400">Total Pemasukan</span>
                        <span class="text-base font-bold text-green-600 dark:text-green-400">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Expenses Section --}}
        <div
            class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-red-50 dark:bg-red-900/20 px-6 py-4 border-b border-red-100 dark:border-red-800">
                <h3 class="text-lg font-semibold text-red-900 dark:text-red-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                    Pengeluaran
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse ($expensesByCategory as $expense)
                        <div
                            class="flex items-center justify-between py-3 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $expense['category'] }}</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                Rp {{ number_format($expense['total'], 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500 dark:text-gray-400 text-sm">
                            Tidak ada pengeluaran
                        </div>
                    @endforelse
                    <div class="flex items-center justify-between py-3 bg-red-50 dark:bg-red-900/20 px-4 rounded-lg">
                        <span class="text-base font-semibold text-red-900 dark:text-red-400">Total Pengeluaran</span>
                        <span class="text-base font-bold text-red-600 dark:text-red-400">
                            Rp {{ number_format($totalExpenses, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Net Profit/Loss Section --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div
                class="bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-50 dark:bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-900/20 px-6 py-4 border-b border-{{ $profit >= 0 ? 'blue' : 'orange' }}-100 dark:border-{{ $profit >= 0 ? 'blue' : 'orange' }}-800">
                <h3
                    class="text-lg font-semibold text-{{ $profit >= 0 ? 'blue' : 'orange' }}-900 dark:text-{{ $profit >= 0 ? 'blue' : 'orange' }}-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    {{ $profit >= 0 ? 'Laba Bersih' : 'Rugi Bersih' }}
                </h3>
            </div>
            <div class="p-6">
                <div
                    class="flex items-center justify-between py-4 bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-50 dark:bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-900/20 px-6 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Pemasukan - Total Pengeluaran
                        </p>
                        <p
                            class="text-2xl font-bold text-{{ $profit >= 0 ? 'blue' : 'orange' }}-600 dark:text-{{ $profit >= 0 ? 'blue' : 'orange' }}-400">
                            Rp {{ number_format(abs($profit), 0, ',', '.') }}
                        </p>
                    </div>
                    <div
                        class="w-16 h-16 bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-100 dark:bg-{{ $profit >= 0 ? 'blue' : 'orange' }}-900/30 rounded-full flex items-center justify-center">
                        @if ($profit >= 0)
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
