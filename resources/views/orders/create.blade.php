<x-app-layout>
    @section('page-title', 'Buat Pesanan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Buat Pesanan Baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Lengkapi informasi pesanan pelanggan
                    </p>
                </div>

                <a href="{{ route('orders.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form Card dengan Alpine.js --}}
        <div class="max-w-5xl mx-auto" x-data="orderForm()" @click.away="customerSearchOpen = false">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('orders.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Icon Order (Dekoratif) --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                    </div>

                    {{-- Customer & Tanggal (Grid 2 kolom di desktop) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Customer Search --}}
                        <div>
                            <x-input-label for="customer_search" value="Customer *" />
                            <div class="relative mt-1">
                                {{-- Search Input --}}
                                <div class="relative">
                                    <input type="text" id="customer_search" x-model="customerSearch"
                                        @input.debounce.300ms="searchCustomers()"
                                        @focus="customerSearch.length >= 2 && searchCustomers()"
                                        placeholder="Ketik nama customer..."
                                        class="block w-full pl-10 pr-10 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        autocomplete="off" />

                                    {{-- Search Icon --}}
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>

                                    {{-- Clear Button --}}
                                    <button type="button" x-show="selectedCustomer" @click="clearCustomer()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    {{-- Loading Spinner --}}
                                    <div x-show="isSearching" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="animate-spin h-5 w-5 text-indigo-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                {{-- Dropdown Results --}}
                                <div x-show="customerSearchOpen" x-transition
                                    class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                    {{-- Customer List --}}
                                    <template x-if="customers.length > 0">
                                        <div>
                                            <template x-for="customer in customers" :key="customer.id">
                                                <div @click="selectCustomer(customer)"
                                                    class="cursor-pointer select-none relative py-3 px-4 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-colors">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center flex-shrink-0">
                                                            <span class="text-white font-bold text-sm"
                                                                x-text="customer.name.substring(0, 2).toUpperCase()"></span>
                                                        </div>
                                                        <div>
                                                            <div class="font-medium text-gray-900 dark:text-white"
                                                                x-text="customer.name"></div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400"
                                                                x-text="customer.phone || 'Tidak ada telepon'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    {{-- No Results --}}
                                    <template
                                        x-if="!isSearching && customers.length === 0 && customerSearch.length >= 2">
                                        <div class="p-4 text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium mb-2">
                                                Customer tidak ditemukan</p>
                                            <a href="{{ route('customers.create') }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                                Daftarkan Customer Baru
                                            </a>
                                        </div>
                                    </template>

                                    {{-- Helper Text --}}
                                    <template x-if="!isSearching && customerSearch.length < 2">
                                        <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Ketik minimal 2 karakter untuk mencari
                                        </div>
                                    </template>
                                </div>

                                {{-- Hidden Input for Form Submission --}}
                                <input type="hidden" name="customer_id" :value="selectedCustomer?.id || ''" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('customer_id')" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ketik nama customer untuk mencari
                            </p>
                        </div>

                        {{-- Tanggal Order --}}
                        <div>
                            <x-input-label for="order_date" value="Tanggal Pesanan *" />
                            <x-text-input id="order_date" name="order_date" type="date" class="mt-1 block w-full"
                                :value="old('order_date', date('Y-m-d'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('order_date')" />
                        </div>

                    </div>

                    {{-- Catatan --}}
                    <div>
                        <x-input-label for="notes" value="Catatan Pesanan" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            placeholder="Tambahkan catatan khusus untuk pesanan ini...">{{ old('notes') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    {{-- Menu Items Section --}}
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilih Menu</h3>
                        </div>

                        {{-- Add Menu Selector --}}
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <select id="menu_selector"
                                    class="flex-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">-- Pilih Menu untuk Ditambahkan --</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">
                                            {{ $menu->name }} - Rp {{ number_format($menu->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button"
                                    @click="addItem(document.getElementById('menu_selector').value); document.getElementById('menu_selector').value = ''"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 dark:bg-indigo-500 text-white font-medium rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors duration-150">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah
                                </button>
                            </div>
                        </div>

                        {{-- Selected Items List --}}
                        <div class="space-y-3">
                            <template x-for="(item, index) in selectedItems" :key="index">
                                <div
                                    class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                        {{-- Menu Name --}}
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white"
                                                x-text="item.name"></h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Harga: Rp <span
                                                    x-text="new Intl.NumberFormat('id-ID').format(item.price)"></span>
                                            </p>
                                            {{-- Hidden inputs for form submission --}}
                                            <input type="hidden" :name="'items[' + index + '][menu_id]'"
                                                :value="item.menu_id">
                                            <input type="hidden" :name="'items[' + index + '][qty]'"
                                                :value="item.qty">
                                        </div>

                                        {{-- Quantity Controls --}}
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-2">
                                                <button type="button" @click="updateQty(index, item.qty - 1)"
                                                    class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <input type="number" x-model.number="item.qty"
                                                    @change="calculateTotal()"
                                                    class="w-16 text-center border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm"
                                                    min="1">
                                                <button type="button" @click="updateQty(index, item.qty + 1)"
                                                    class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>

                                            {{-- Subtotal --}}
                                            <div class="text-right min-w-[100px]">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Subtotal</p>
                                                <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                    Rp <span
                                                        x-text="new Intl.NumberFormat('id-ID').format(getSubtotal(item))"></span>
                                                </p>
                                            </div>

                                            {{-- Remove Button --}}
                                            <button type="button" @click="removeItem(index)"
                                                class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            {{-- Empty State --}}
                            <div x-show="selectedItems.length === 0"
                                class="p-8 text-center bg-gray-50 dark:bg-gray-800/50 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-600 dark:text-gray-400 font-medium">Belum ada menu yang dipilih</p>
                                <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Pilih menu dari dropdown di
                                    atas untuk menambahkan item</p>
                            </div>
                        </div>

                        {{-- Total Price --}}
                        <div x-show="selectedItems.length > 0"
                            class="mt-6 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-gray-900 dark:text-white">Total Harga:</span>
                                <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                    Rp <span x-text="new Intl.NumberFormat('id-ID').format(totalPrice)"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Validation Error for items --}}
                    <x-input-error class="mt-2" :messages="$errors->get('items')" />

                    {{-- Form Actions --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('orders.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            Batal
                        </a>

                        <button type="submit" x-bind:disabled="!selectedCustomer || selectedItems.length === 0"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium rounded-lg hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-none transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Pesanan
                        </button>
                    </div>

                </form>
            </div>

            {{-- Info Card --}}
            <div
                class="mt-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0 mt-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-indigo-800 dark:text-indigo-300">
                        <p class="font-medium mb-1">Tips Membuat Pesanan:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Ketik minimal 2 karakter untuk mencari customer</li>
                            <li>Jika customer belum terdaftar, klik "Daftarkan Customer Baru"</li>
                            <li>Pilih tanggal pesanan sesuai dengan jadwal pengiriman</li>
                            <li>Tambahkan minimal 1 menu untuk melanjutkan</li>
                            <li>Cek kembali total harga sebelum menyimpan</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Alpine.js Component --}}
    <script>
        function orderForm() {
            return {
                // Customer Search
                customerSearch: '',
                customerSearchOpen: false,
                selectedCustomer: null,
                customers: [],
                isSearching: false,

                async searchCustomers() {
                    if (this.customerSearch.length < 2) {
                        this.customers = [];
                        this.customerSearchOpen = false;
                        return;
                    }

                    this.isSearching = true;
                    this.customerSearchOpen = true;

                    try {
                        const response = await fetch(`/customers/search?q=${encodeURIComponent(this.customerSearch)}`);
                        const data = await response.json();
                        this.customers = data;
                    } catch (error) {
                        console.error('Error searching customers:', error);
                        this.customers = [];
                    } finally {
                        this.isSearching = false;
                    }
                },

                selectCustomer(customer) {
                    this.selectedCustomer = customer;
                    this.customerSearch = customer.name;
                    this.customerSearchOpen = false;
                },

                clearCustomer() {
                    this.selectedCustomer = null;
                    this.customerSearch = '';
                    this.customers = [];
                },

                // Order Items
                selectedItems: [],
                totalPrice: 0,
                menus: @json($menus),

                addItem(menuId) {
                    const menu = this.menus.find(m => m.id === parseInt(menuId));
                    if (!menu) return;

                    const existing = this.selectedItems.find(item => item.menu_id === menu.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.selectedItems.push({
                            menu_id: menu.id,
                            name: menu.name,
                            price: menu.price,
                            qty: 1
                        });
                    }
                    this.calculateTotal();
                },

                removeItem(index) {
                    this.selectedItems.splice(index, 1);
                    this.calculateTotal();
                },

                updateQty(index, qty) {
                    if (qty < 1) {
                        this.removeItem(index);
                    } else {
                        this.selectedItems[index].qty = qty;
                        this.calculateTotal();
                    }
                },

                calculateTotal() {
                    this.totalPrice = this.selectedItems.reduce((sum, item) => {
                        return sum + (item.price * item.qty);
                    }, 0);
                },

                getSubtotal(item) {
                    return item.price * item.qty;
                }
            }
        }
    </script>
</x-app-layout>
