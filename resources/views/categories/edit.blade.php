<x-app-layout>
    @section('page-title', 'Edit Kategori')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Edit Kategori
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Perbarui informasi kategori yang sudah ada
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
            isActive: {{ $category->is_active ? 'true' : 'false' }}
        }">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('categories.update', $category) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Icon Kategori (Dekoratif) --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Nama Kategori --}}
                    <div>
                        <x-input-label for="name" value="Nama Kategori *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $category->name)" required autofocus placeholder="Contoh: Makanan Utama" />
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
                                    class="sr-only peer" x-model="isActive" {{ $category->is_active ? 'checked' : '' }}>
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

                    {{-- Info Last Updated --}}
                    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <p class="font-medium mb-1">Informasi Kategori:</p>
                                <p class="text-xs">Dibuat: {{ $category->created_at->format('d M Y, H:i') }}</p>
                                <p class="text-xs">Terakhir diubah: {{ $category->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Kategori
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
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <div class="text-sm text-indigo-800 dark:text-indigo-300">
                        <p class="font-medium mb-1">Tips Edit Kategori:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Pastikan nama kategori tetap konsisten dengan menu yang ada</li>
                            <li>Menonaktifkan kategori akan menyembunyikan semua menu di dalamnya</li>
                            <li>Perubahan nama kategori akan langsung terlihat di aplikasi</li>
                            <li>Pertimbangkan dampak perubahan terhadap menu yang sudah ada</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Warning Card (jika ada menu) --}}
            @if ($category->menus && $category->menus->count() > 0)
                <div
                    class="mt-4 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div class="text-sm text-amber-800 dark:text-amber-300">
                            <p class="font-medium mb-1">Perhatian!</p>
                            <p class="text-xs">Kategori ini memiliki {{ $category->menus->count() }} menu. Menonaktifkan
                                kategori akan menyembunyikan semua menu di dalamnya dari pelanggan.</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</x-app-layout>
