<x-app-layout>
    <div class="flex min-h-screen bg-gray-50 dark:bg-gray-950">

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col lg:ml-0">

            {{-- Top Bar (Mobile) --}}
            <div
                class="lg:hidden sticky top-0 z-30 h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center px-4">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Dashboard
                </h1>
            </div>

            {{-- Content Area --}}
            <div class="flex-1 p-4 md:p-6 lg:p-8 overflow-x-hidden">

                {{-- Header --}}
                <div class="mb-6 md:mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Dashboard Admin
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Selamat datang kembali! Berikut ringkasan bisnis Anda hari ini.
                    </p>
                </div>

                {{-- Stats Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">

                    {{-- Total Orders --}}
                    <div
                        class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm 
                                hover:shadow-xl dark:shadow-gray-900/50 
                                border border-gray-100 dark:border-gray-800
                                transition-all duration-300 hover:-translate-y-1 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg 
                                        group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-full">
                                All Time
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Order</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalOrders) }}
                        </p>
                    </div>

                    {{-- Today Orders --}}
                    <div
                        class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm 
                                hover:shadow-xl dark:shadow-gray-900/50 
                                border border-gray-100 dark:border-gray-800
                                transition-all duration-300 hover:-translate-y-1 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg 
                                        group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">
                                Today
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Order Hari Ini</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($todayOrders) }}
                        </p>
                    </div>

                    {{-- Revenue --}}
                    <div
                        class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm 
                                hover:shadow-xl dark:shadow-gray-900/50 
                                border border-gray-100 dark:border-gray-800
                                transition-all duration-300 hover:-translate-y-1 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg 
                                        group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-full">
                                IDR
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Revenue</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Active Menu --}}
                    <div
                        class="group bg-white dark:bg-gray-900 rounded-xl shadow-sm 
                                hover:shadow-xl dark:shadow-gray-900/50 
                                border border-gray-100 dark:border-gray-800
                                transition-all duration-300 hover:-translate-y-1 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg 
                                        group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">
                                Active
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Menu Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($activeMenus) }}
                        </p>
                    </div>

                </div>

                {{-- Recent Orders Table --}}
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm 
                            border border-gray-100 dark:border-gray-800 
                            overflow-hidden">

                    {{-- Table Header --}}
                    <div
                        class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Terbaru</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Daftar transaksi terbaru dari
                                pelanggan</p>
                        </div>
                        <a href="{{ route('orders.index') }}"
                            class="hidden sm:inline-flex items-center gap-2 px-4 py-2 
                                  bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700
                                  text-gray-700 dark:text-gray-300 rounded-lg 
                                  transition-colors duration-200 text-sm font-medium">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- Table Content --}}
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($latestOrders as $order)
                                    <tr
                                        class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                                    {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $order->customer->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden">
                                                        {{ $order->status }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center hidden sm:table-cell">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                {{ $order->status === 'completed' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : '' }}
                                                {{ $order->status === 'pending' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400' : '' }}
                                                {{ $order->status === 'processing' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400' : '' }}">
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
                                            <div class="text-xs text-gray-500 dark:text-gray-500">
                                                {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <p class="text-gray-600 dark:text-gray-400 font-medium">Belum ada order
                                                </p>
                                                <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Order dari
                                                    pelanggan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile "View All" Button --}}
                    <div class="sm:hidden px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('orders.index') }}"
                            class="flex items-center justify-center gap-2 w-full py-2.5
                                  bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700
                                  text-gray-700 dark:text-gray-300 rounded-lg 
                                  transition-colors duration-200 text-sm font-medium">
                            Lihat Semua Order
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
