<x-app-layout>
    @section('page-title', 'Detail Pelanggan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Detail Pelanggan
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Informasi lengkap dan riwayat pesanan pelanggan
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('customers.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 
                              bg-white dark:bg-gray-800 
                              border border-gray-300 dark:border-gray-700
                              text-gray-700 dark:text-gray-300 
                              rounded-lg text-sm font-medium
                              hover:bg-gray-50 dark:hover:bg-gray-700
                              focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                              transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>

                    <a href="{{ route('customers.edit', $customer) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 
                              bg-blue-600 dark:bg-blue-500 
                              text-white 
                              rounded-lg text-sm font-medium
                              hover:bg-blue-700 dark:hover:bg-blue-600
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                              transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto space-y-6">

            {{-- Customer Info Card --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        <div
                            class="w-32 h-32 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <span class="text-white font-bold text-4xl">
                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                            </span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $customer->name }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Customer ID: #{{ $customer->id }}
                        </p>

                        <div class="space-y-3">
                            {{-- Phone --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nomor Telepon</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $customer->phone }}
                                    </p>
                                </div>
                            </div>

                            {{-- Address --}}
                            @if ($customer->address)
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $customer->address }}</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Registration Date --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Terdaftar Sejak</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $customer->created_at->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="flex md:flex-col gap-3">
                        <div
                            class="flex-1 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg p-4 text-center border border-indigo-200 dark:border-indigo-800">
                            <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ $customer->orders->count() }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Total Pesanan</p>
                        </div>

                        @php
                            $totalSpent = $customer->orders->sum('total_price');
                        @endphp
                        <div
                            class="flex-1 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg p-4 text-center border border-green-200 dark:border-green-800">
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">
                                Rp {{ number_format($totalSpent / 1000, 0) }}K
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Total Belanja</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order History --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Riwayat Pesanan
                        </h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $customer->orders->count() }} pesanan
                        </span>
                    </div>
                </div>

                @if ($customer->orders->count() > 0)
                    {{-- Desktop Table --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        ID Order
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @foreach ($customer->orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                                                    <span
                                                        class="text-white font-bold text-xs">#{{ $order->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-gray-900 dark:text-white">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                $statusColors = [
                                                    'pending' =>
                                                        'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400',
                                                    'confirmed' =>
                                                        'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400',
                                                    'cooking' =>
                                                        'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-400',
                                                    'ready' =>
                                                        'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400',
                                                    'delivered' =>
                                                        'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400',
                                                    'canceled' =>
                                                        'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400',
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Pending',
                                                    'confirmed' => 'Dikonfirmasi',
                                                    'cooking' => 'Dimasak',
                                                    'ready' => 'Siap',
                                                    'delivered' => 'Terkirim',
                                                    'canceled' => 'Dibatalkan',
                                                ];
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? $statusColors['pending'] }}">
                                                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <a href="{{ route('orders.show', $order) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 
                                                      bg-blue-100 dark:bg-blue-900/30 
                                                      text-blue-700 dark:text-blue-400 
                                                      rounded-lg text-xs font-medium
                                                      hover:bg-blue-200 dark:hover:bg-blue-900/50
                                                      transition-colors duration-150">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile Cards --}}
                    <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach ($customer->orders as $order)
                            <div class="p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">#{{ $order->id }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                Order #{{ $order->id }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    @php
                                        $statusColors = [
                                            'pending' =>
                                                'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400',
                                            'confirmed' =>
                                                'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400',
                                            'cooking' =>
                                                'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-400',
                                            'ready' =>
                                                'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400',
                                            'delivered' =>
                                                'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400',
                                            'canceled' =>
                                                'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Pending',
                                            'confirmed' => 'Dikonfirmasi',
                                            'cooking' => 'Dimasak',
                                            'ready' => 'Siap',
                                            'delivered' => 'Terkirim',
                                            'canceled' => 'Dibatalkan',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? $statusColors['pending'] }}">
                                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-2
                                              bg-blue-100 dark:bg-blue-900/30 
                                              text-blue-700 dark:text-blue-400 
                                              rounded-lg text-sm font-medium
                                              hover:bg-blue-200 dark:hover:bg-blue-900/50
                                              transition-colors duration-150">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">Belum ada riwayat pesanan</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Pelanggan ini belum melakukan pesanan
                        </p>

                        <a href="{{ route('orders.create') }}"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 
                                  bg-gradient-to-r from-indigo-500 to-purple-500 
                                  text-white font-medium rounded-lg
                                  hover:shadow-lg hover:shadow-indigo-500/50
                                  transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Pesanan Baru
                        </a>
                    </div>
                @endif
            </div>

        </div>

    </div>
</x-app-layout>
