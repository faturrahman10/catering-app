<x-app-layout>
    @section('page-title', 'Menu')

    {{-- Page Content Alpine.js Filter --}}
    <div class="p-4 md:p-6 lg:p-8" x-data="{
        searchTerm: '',
        statusFilter: 'all',
        categoryFilter: 'all',
        menus: {{ $menus->toJson() }},
    
        get filteredMenus() {
            return this.menus.filter(menu => {
                const matchesSearch = menu.name.toLowerCase().includes(this.searchTerm.toLowerCase());
                const matchesStatus = this.statusFilter === 'all' ||
                    (this.statusFilter === 'active' && menu.is_active) ||
                    (this.statusFilter === 'inactive' && !menu.is_active);
                const matchesCategory = this.categoryFilter === 'all' ||
                    menu.category_id == this.categoryFilter;
    
                return matchesSearch && matchesStatus && matchesCategory;
            });
        }
    }">

        {{-- Header dengan Search & Action --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Daftar Menu
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Kelola menu makanan dan minuman yang tersedia
                    </p>
                </div>

                {{-- Menggunakan link --}}
                <a href="{{ route('menus.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 
                          bg-gradient-to-r from-indigo-500 to-purple-500 
                          text-white font-medium rounded-lg
                          hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950
                          transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Menu</span>
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-6 md:mb-8">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Menu</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white" x-text="menus.length">0</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Menu Aktif</p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400"
                    x-text="menus.filter(m => m.is_active).length">0</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kategori</p>
                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                    {{ $menus->pluck('category_id')->unique()->count() }}</p>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="mb-6 bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-100 dark:border-gray-800">
            <div class="flex flex-col sm:flex-row gap-3">
                {{-- Search Input --}}
                <div class="flex-1">
                    <div class="relative">
                        <x-text-input type="text" x-model="searchTerm" placeholder="Cari menu..."
                            class="w-full pl-10" />
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
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>

                {{-- Category Filter --}}
                <select x-model="categoryFilter"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                               focus:border-indigo-500 dark:focus:border-indigo-600 
                               focus:ring-indigo-500 dark:focus:ring-indigo-600 
                               rounded-md shadow-sm">
                    <option value="all">Semua Kategori</option>
                    @foreach ($menus->pluck('category')->unique() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Menu Grid/Table --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

            {{-- Desktop Table View --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Menu
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Harga
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
                        <template x-for="menu in filteredMenus" :key="menu.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <template x-if="menu.image">
                                            <img :src="'/storage/' + menu.image" :alt="menu.name"
                                                class="w-16 h-16 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-800">
                                        </template>
                                        <template x-if="!menu.image">
                                            <div
                                                class="w-16 h-16 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 
                                                        flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400 dark:text-gray-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </template>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white truncate"
                                                x-text="menu.name"></div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mt-1"
                                                x-text="menu.description || 'Tidak ada deskripsi'"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400"
                                        x-text="menu.category.name"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        <span>Rp </span><span
                                            x-text="new Intl.NumberFormat('id-ID').format(menu.price)"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <template x-if="menu.is_active">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                     bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Aktif
                                        </span>
                                    </template>
                                    <template x-if="!menu.is_active">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                                     bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                            Nonaktif
                                        </span>
                                    </template>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="'/menus/' + menu.id + '/edit'"
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form :action="'/menus/' + menu.id" method="POST"
                                            @submit="return confirm('Yakin ingin menghapus menu ' + menu.name + '?')">
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
                        <tr x-show="filteredMenus.length === 0">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">Menu tidak ditemukan</p>
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
                <template x-for="menu in filteredMenus" :key="menu.id">
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-150">
                        <div class="flex gap-4">
                            {{-- Image --}}
                            <template x-if="menu.image">
                                <img :src="'/storage/' + menu.image" :alt="menu.name"
                                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-800 flex-shrink-0">
                            </template>
                            <template x-if="!menu.image">
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 
                                            flex items-center justify-center flex-shrink-0">
                                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </template>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white"
                                        x-text="menu.name"></h3>
                                    <template x-if="menu.is_active">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                                     bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 flex-shrink-0">
                                            Aktif
                                        </span>
                                    </template>
                                    <template x-if="!menu.is_active">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                                     bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 flex-shrink-0">
                                            Nonaktif
                                        </span>
                                    </template>
                                </div>

                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-2"
                                    x-text="menu.description || 'Tidak ada deskripsi'"></p>

                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                                 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400"
                                        x-text="menu.category.name"></span>
                                    <span class="text-base font-bold text-gray-900 dark:text-white">
                                        <span>Rp </span><span
                                            x-text="new Intl.NumberFormat('id-ID').format(menu.price)"></span>
                                    </span>
                                </div>

                                {{-- Actions --}}
                                <div class="flex gap-2">
                                    <a :href="'/menus/' + menu.id + '/edit'"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form :action="'/menus/' + menu.id" method="POST" class="flex-1"
                                        @submit="return confirm('Yakin ingin menghapus menu ' + menu.name + '?')">
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
                <div x-show="filteredMenus.length === 0" class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 font-medium">Menu tidak ditemukan</p>
                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Coba ubah filter atau kata kunci pencarian
                    </p>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
