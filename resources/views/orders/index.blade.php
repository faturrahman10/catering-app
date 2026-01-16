<x-app-layout>
    @section('page-title', 'Orders')

    {{-- Page Content Alpine.js Filter --}}
    <div class="p-4 md:p-6 lg:p-8" x-data="{
        searchTerm: '',
        statusFilter: 'all',
        orders: {{ $orders->toJson() }},
    
        get filteredOrders() {
            return this.orders.filter(order => {
                const matchesSearch =
                    order.customer.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    order.id.toString().includes(this.searchTerm);
                const matchesStatus = this.statusFilter === 'all' || order.status === this.statusFilter;
    
                return matchesSearch && matchesStatus;
            });
        },
    
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

        {{-- Header dengan Search & Action --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Daftar Pesanan
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Kelola semua pesanan pelanggan
                    </p>
                </div>

                <a href="{{ route('orders.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 
                          bg-gradient-to-r from-indigo-500 to-purple-500 
                          text-white font-medium rounded-lg
                          hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                          transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Buat Pesanan</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 md:mb-8">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Pesanan</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white" x-text="orders.length">0</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Pending</p>
                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400"
                    x-text="orders.filter(o => o.status === 'pending').length">0</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Diproses</p>
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400"
                    x-text="orders.filter(o => ['confirmed', 'cooking', 'ready'].includes(o.status)).length">0</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Selesai</p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400"
                    x-text="orders.filter(o => o.status === 'delivered').length">0</p>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="mb-6 bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
            <div class="flex flex-col sm:flex-row gap-3">
                {{-- Search Input --}}
                <div class="flex-1">
                    <div class="relative">
                        <x-text-input type="text" x-model="searchTerm"
                            placeholder="Cari berdasarkan ID atau nama customer..." class="w-full pl-10" />
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400 pointer-events-none" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Status Filter --}}
                <select x-model="statusFilter"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                               focus:border-indigo-500 dark:focus:border-indigo-600 
                               focus:ring-indigo-500 dark:focus:ring-indigo-600 
                               rounded-md shadow-sm">
                    <option value="all">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Dikonfirmasi</option>
                    <option value="cooking">Dimasak</option>
                    <option value="ready">Siap</option>
                    <option value="delivered">Terkirim</option>
                    <option value="canceled">Dibatalkan</option>
                </select>
            </div>
        </div>

        {{-- Orders Table/Cards --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

            {{-- Desktop Table View --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                ID Order
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Customer
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
                        <template x-for="order in filteredOrders" :key="order.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-sm" x-text="'#' + order.id"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white"
                                        x-text="order.customer.name"></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400"
                                        x-text="order.customer.phone || '-'"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white"
                                        x-text="new Date(order.order_date).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'})">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white">
                                        <span>Rp </span><span
                                            x-text="new Intl.NumberFormat('id-ID').format(order.total_price)"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span :class="getStatusColor(order.status)"
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium">
                                        <span x-text="getStatusLabel(order.status)"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="'/orders/' + order.id"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 
                                                  bg-blue-100 dark:bg-blue-900/30 
                                                  text-blue-700 dark:text-blue-400 
                                                  rounded-lg text-xs font-medium
                                                  hover:bg-blue-200 dark:hover:bg-blue-900/50
                                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
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

                                        <form :action="'/orders/' + order.id" method="POST"
                                            @submit="return confirm('Yakin ingin menghapus order #' + order.id + '?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 
                                                           bg-red-100 dark:bg-red-900/30 
                                                           text-red-700 dark:text-red-400 
                                                           rounded-lg text-xs font-medium
                                                           hover:bg-red-200 dark:hover:bg-red-900/50
                                                           focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                                                           transition-colors duration-150">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        {{-- Empty State --}}
                        <tr x-show="filteredOrders.length === 0">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">Pesanan tidak ditemukan</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Coba ubah filter atau kata
                                        kunci pencarian</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Mobile/Tablet Card View --}}
            <div class="lg:hidden divide-y divide-gray-100 dark:divide-gray-800">
                <template x-for="order in filteredOrders" :key="order.id">
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                        <div class="flex items-start gap-4">
                            {{-- Order Icon --}}
                            <div
                                class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm" x-text="'#' + order.id"></span>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white"
                                            x-text="order.customer.name"></h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400"
                                            x-text="order.customer.phone || '-'"></p>
                                    </div>
                                    <span :class="getStatusColor(order.status)"
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium flex-shrink-0">
                                        <span x-text="getStatusLabel(order.status)"></span>
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        <span
                                            x-text="new Date(order.order_date).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'})"></span>
                                    </span>
                                    <span class="text-base font-bold text-gray-900 dark:text-white">
                                        <span>Rp </span><span
                                            x-text="new Intl.NumberFormat('id-ID').format(order.total_price)"></span>
                                    </span>
                                </div>

                                {{-- Actions --}}
                                <div class="flex gap-2">
                                    <a :href="'/orders/' + order.id"
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2
                                              bg-blue-100 dark:bg-blue-900/30 
                                              text-blue-700 dark:text-blue-400 
                                              rounded-lg text-sm font-medium
                                              hover:bg-blue-200 dark:hover:bg-blue-900/50
                                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
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

                                    <form :action="'/orders/' + order.id" method="POST" class="flex-1"
                                        @submit="return confirm('Yakin ingin menghapus order #' + order.id + '?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2
                                                       bg-red-100 dark:bg-red-900/30 
                                                       text-red-700 dark:text-red-400 
                                                       rounded-lg text-sm font-medium
                                                       hover:bg-red-200 dark:hover:bg-red-900/50
                                                       focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                                                       transition-colors duration-150">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Empty State --}}
                <div x-show="filteredOrders.length === 0" class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 font-medium">Pesanan tidak ditemukan</p>
                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Coba ubah filter atau kata kunci pencarian
                    </p>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
