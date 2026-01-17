<x-app-layout>
    @section('page-title', 'Tambah Pelanggan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Tambah Pelanggan Baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Lengkapi informasi pelanggan baru
                    </p>
                </div>

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
            </div>
        </div>

        {{-- Form Card --}}
        <div class="max-w-3xl mx-auto">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('customers.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Icon Customer (Dekoratif) --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Nama Pelanggan --}}
                    <div>
                        <x-input-label for="name" value="Nama Pelanggan *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" required autofocus placeholder="Contoh: Ahmad Sudrajat" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Masukkan nama lengkap pelanggan
                        </p>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <x-input-label for="phone" value="Nomor Telepon *" />
                        <div class="relative mt-1">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <x-text-input id="phone" name="phone" type="text" class="block w-full pl-12"
                                :value="old('phone')" required placeholder="08123456789" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Format: 08xxxxxxxxxx atau +628xxxxxxxxxx
                        </p>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <x-input-label for="address" value="Alamat" />
                        <textarea id="address" name="address" rows="4"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                                   focus:border-indigo-500 dark:focus:border-indigo-600 
                                   focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                   rounded-md shadow-sm"
                            placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Kode Pos">{{ old('address') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Opsional - Alamat lengkap untuk pengiriman
                        </p>
                    </div>

                    {{-- Form Actions --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('customers.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 
                                  bg-white dark:bg-gray-800 
                                  border border-gray-300 dark:border-gray-700
                                  text-gray-700 dark:text-gray-300 
                                  rounded-lg text-sm font-medium
                                  hover:bg-gray-50 dark:hover:bg-gray-700
                                  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                  transition-colors duration-150">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 
                                       bg-gradient-to-r from-indigo-500 to-purple-500 
                                       text-white font-medium rounded-lg
                                       hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                                       transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Simpan Pelanggan
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
                        <p class="font-medium mb-1">Tips Menambah Pelanggan:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Pastikan nama pelanggan lengkap dan jelas</li>
                            <li>Nomor telepon yang aktif memudahkan komunikasi</li>
                            <li>Alamat lengkap membantu proses pengiriman</li>
                            <li>Data pelanggan dapat diupdate kapan saja</li>
                            <li>Pelanggan yang sudah terdaftar dapat langsung membuat pesanan</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Quick Info Stats --}}
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Data Lengkap</p>
                    <p class="text-lg font-bold text-green-600 dark:text-green-400">+30%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Repeat Order</p>
                </div>
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Kontak Aktif</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">+50%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Kepuasan</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
