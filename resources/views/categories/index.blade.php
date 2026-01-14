<x-app-layout>
    @section('page-title', 'Kategori Menu')

    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Daftar Kategori
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Kelola kategori menu yang tersedia
                    </p>
                </div>

                <a href="{{ route('categories.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                           bg-gradient-to-r from-indigo-500 to-purple-500
                           text-white font-medium rounded-lg
                           hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                           dark:focus:ring-offset-gray-950
                           transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Kategori</span>
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nama Kategori
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
                        @forelse ($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $category->name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($category->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                   bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                   bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5
                                                   bg-blue-100 dark:bg-blue-900/30
                                                   text-blue-700 dark:text-blue-400
                                                   rounded-lg text-xs font-medium
                                                   hover:bg-blue-200 dark:hover:bg-blue-900/50
                                                   transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Nonaktifkan kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5
                                                       bg-red-100 dark:bg-red-900/30
                                                       text-red-700 dark:text-red-400
                                                       rounded-lg text-xs font-medium
                                                       hover:bg-red-200 dark:hover:bg-red-900/50
                                                       transition">
                                                Nonaktifkan
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">
                                        Belum ada kategori
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
