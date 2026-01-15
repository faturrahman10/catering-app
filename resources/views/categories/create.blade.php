<x-app-layout>
    @section('page-title', 'Tambah Kategori')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Tambah Kategori Baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Lengkapi informasi kategori yang akan ditambahkan
                    </p>
                </div>

                <a href="{{ route('categories.index') }}"
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

        {{-- Form Card dengan Alpine.js --}}
        <div class="max-w-3xl mx-auto" x-data="{
            isActive: true
        }">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Icon Kategori (Dekoratif) --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 7h10M7 12h6M7 17h4" />
                            </svg>
                        </div>
                    </div>

                    {{-- Nama Kategori --}}
                    <div>
                        <x-input-label for="name" value="Nama Kategori *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" required autofocus placeholder="Contoh: Makanan Utama" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Masukkan nama kategori yang jelas dan mudah dipahami
                        </p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <x-input-label for="is_active" value="Status Kategori" />
                        <div class="mt-3 flex items-center gap-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                    class="sr-only peer" x-model="isActive" checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Kategori Aktif
                                </span>
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Kategori yang aktif akan langsung ditampilkan di aplikasi
                        </p>
                    </div>

                    {{-- Form Actions --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('categories.index') }}"
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
                            Simpan Kategori
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
                        <p class="font-medium mb-1">Informasi Kategori:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Kategori membantu mengorganisir menu dengan lebih baik</li>
                            <li>Gunakan nama yang singkat dan mudah dimengerti pelanggan</li>
                            <li>Kategori yang tidak aktif tidak akan muncul di aplikasi</li>
                            <li>Anda dapat mengubah status kategori kapan saja</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Organisasi Menu</p>
                    <p class="text-lg font-bold text-green-600 dark:text-green-400">+50%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Lebih Mudah</p>
                </div>
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Navigasi User</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">+35%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Lebih Cepat</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
