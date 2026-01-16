<x-app-layout>
    @section('page-title', 'Detail Pesanan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Detail Pesanan #{{ $order->id }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Informasi lengkap pesanan pelanggan
                    </p>
                </div>

                <a href="{{ route('orders.index') }}"
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
            </div>
        </div>

        <div class="max-w-5xl mx-auto space-y-6">

            {{-- Status & Customer Info --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Status Card --}}
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Status Pesanan
                    </h2>

                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" x-data="{
                        selectedStatus: '{{ $order->status }}',
                        getStatusColor(status) {
                            const colors = {
                                'pending': 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400',
                                'confirmed': 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400',
                                'cooking': 'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-400',
                                'ready': 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400',
                                'delivered': 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400',
                                'canceled': 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400'
                            };
                            return colors[status] || colors.pending;
                        },
                        getStatusLabel(status) {
                            const labels = {
                                'pending': 'Pending',
                                'confirmed': 'Dikonfirmasi',
                                'cooking': 'Dimasak',
                                'ready': 'Siap',
                                'delivered': 'Terkirim',
                                'canceled': 'Dibatalkan'
                            };
                            return labels[status] || status;
                        }
                    }">
                        @csrf
                        @method('PATCH')

                        {{-- Current Status Display --}}
                        <div class="mb-4 p-4 rounded-lg" :class="getStatusColor(selectedStatus)">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold" x-text="'Status: ' + getStatusLabel(selectedStatus)"></span>
                            </div>
                        </div>

                        {{-- Status Selector --}}
                        <div class="space-y-3 mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ubah Status:
                            </label>
                            <select name="status" x-model="selectedStatus"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                                       focus:border-indigo-500 dark:focus:border-indigo-600 
                                       focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                       rounded-md shadow-sm"
                                @if ($order->status === 'canceled') disabled @endif>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Dikonfirmasi</option>
                                <option value="cooking">Dimasak</option>
                                <option value="ready">Siap</option>
                                <option value="delivered">Terkirim</option>
                                <option value="canceled">Dibatalkan</option>
                            </select>
                        </div>

                        {{-- Update Button --}}
                        @if ($order->status !== 'canceled')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 
                                       bg-gradient-to-r from-indigo-500 to-purple-500 
                                       text-white font-medium rounded-lg
                                       hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                                       transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Status
                            </button>
                        @else
                            <div
                                class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <p class="text-sm text-red-700 dark:text-red-400 text-center">
                                    Pesanan yang dibatalkan tidak dapat diubah
                                </p>
                            </div>
                        @endif
                    </form>

                    {{-- Timeline/History (Optional enhancement) --}}
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Informasi Waktu:</h3>
                        <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Dibuat: {{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Diupdate: {{ $order->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Customer Info Card --}}
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Informasi Pelanggan
                    </h2>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-lg">
                                    {{ strtoupper(substr($order->customer->name, 0, 2)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $order->customer->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Customer</p>
                            </div>
                        </div>

                        <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $order->customer->phone ?? 'Tidak ada nomor telepon' }}
                                </span>
                            </div>

                            @if ($order->customer->email)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ $order->customer->email }}</span>
                                </div>
                            @endif

                            @if ($order->customer->address)
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ $order->customer->address }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Order Date --}}
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Pesanan</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Order Items --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Detail Pesanan
                    </h2>
                </div>

                {{-- Desktop Table --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Menu
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Harga Satuan
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($order->items as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($item->menu->image)
                                                <img src="{{ asset('storage/' . $item->menu->image) }}"
                                                    alt="{{ $item->menu->name }}"
                                                    class="w-12 h-12 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-800">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-600"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $item->menu->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $item->menu->category->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                     bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                            {{ $item->qty }} x
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm text-gray-900 dark:text-white">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View --}}
                <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($order->items as $item)
                        <div class="p-4">
                            <div class="flex gap-3">
                                @if ($item->menu->image)
                                    <img src="{{ asset('storage/' . $item->menu->image) }}"
                                        alt="{{ $item->menu->name }}"
                                        class="w-16 h-16 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-800 flex-shrink-0">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                        {{ $item->menu->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                        {{ $item->menu->category->name }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <div
                    class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border-t-2 border-indigo-200 dark:border-indigo-800">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Total Harga:</span>
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Notes Section --}}
            @if ($order->notes)
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Catatan Pesanan:</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->notes }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</x-app-layout>
