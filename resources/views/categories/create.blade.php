<x-app-layout>
    @section('page-title', 'Tambah Kategori')

    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Tambah Kategori
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Buat kategori baru untuk mengelompokkan menu
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
                           transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="max-w-xl mx-auto">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Nama Kategori --}}
                    <div>
                        <x-input-label for="name" value="Nama Kategori *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" placeholder="Contoh: Menu Utama" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Status --}}
                    <div>
                        <x-input-label value="Status Kategori" />
                        <label class="mt-3 inline-flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800
                                       rounded-full peer dark:bg-gray-700
                                       peer-checked:after:translate-x-full after:content-['']
                                       after:absolute after:top-[2px] after:start-[2px]
                                       after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                       peer-checked:bg-indigo-600">
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                Aktif
                            </span>
                        </label>
                    </div>

                    {{-- Action --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('categories.index') }}"
                            class="inline-flex justify-center px-4 py-2
                                   bg-white dark:bg-gray-800
                                   border border-gray-300 dark:border-gray-700
                                   text-gray-700 dark:text-gray-300
                                   rounded-lg text-sm font-medium
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   transition-colors">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex justify-center items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-indigo-500 to-purple-500
                                   text-white font-medium rounded-lg
                                   hover:shadow-lg hover:shadow-indigo-500/40 hover:scale-105
                                   transition-all">
                            Simpan Kategori
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>
