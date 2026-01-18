<x-app-layout>
    @section('page-title', 'Tambah Menu')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Tambah Menu Baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Lengkapi informasi menu yang akan ditambahkan
                    </p>
                </div>

                <a href="{{ route('menus.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form Card dengan Alpine.js --}}
        <div class="max-w-3xl mx-auto" x-data="menuForm()">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-6">
                    @csrf

                    {{-- Icon Dekoratif (Konsisten dengan form lain) --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>

                    {{-- Nama Menu --}}
                    <div>
                        <x-input-label for="name" value="Nama Menu *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name')" required autofocus placeholder="Contoh: Nasi Goreng Spesial" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Kategori & Status (Grid 2 kolom di desktop) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="category_id" value="Kategori *" />
                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        {{-- Status --}}
                        <div>
                            <x-input-label for="is_active" value="Status Menu" />
                            <div class="mt-3 flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="is_active" name="is_active" value="1"
                                        class="sr-only peer" x-model="isActive" checked>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                                    </div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Menu Aktif
                                    </span>
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Menu yang aktif akan langsung ditampilkan kepada pelanggan
                            </p>
                        </div>

                    </div>

                    {{-- Harga --}}
                    <div>
                        <x-input-label for="price" value="Harga (Rp) *" />
                        <div class="relative mt-1">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400 pointer-events-none">
                                Rp
                            </span>
                            <x-text-input id="price" name="price" type="number" class="block w-full pl-12"
                                :value="old('price')" min="0" step="1000" required placeholder="15000" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Masukkan harga dalam rupiah (tanpa titik atau koma)
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            placeholder="Jelaskan menu ini, bahan-bahan, atau keunikannya...">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Deskripsi membantu pelanggan memahami menu lebih baik
                        </p>
                    </div>

                    {{-- Upload Gambar dengan Preview Langsung --}}
                    <div>
                        <x-input-label for="image" value="Gambar Menu" />

                        {{-- Preview atau Upload Area --}}
                        <div class="mt-1">
                            {{-- Jika sudah ada preview, tampilkan gambar --}}
                            <div x-show="imagePreview" x-cloak class="relative">
                                <img :src="imagePreview" alt="Preview"
                                    class="w-full h-64 object-cover rounded-lg border-2 border-indigo-500">

                                {{-- Overlay dengan tombol aksi --}}
                                <div
                                    class="absolute inset-0 bg-black/50 rounded-lg opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                    <button type="button" @click="$refs.imageInput.click()"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-900 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        Ganti
                                    </button>
                                    <button type="button" @click="removePreview()"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            {{-- Jika belum ada preview, tampilkan upload area --}}
                            <label x-show="!imagePreview" for="image"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG atau JPEG (MAX. 2MB)
                                    </p>
                                </div>
                            </label>

                            {{-- Hidden Input --}}
                            <input id="image" name="image" type="file" class="hidden"
                                accept="image/png,image/jpeg,image/jpg" x-ref="imageInput"
                                @change="previewImage($event)" />
                        </div>

                        <x-input-error class="mt-2" :messages="$errors->get('image')" />

                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            💡 Tips: Gambar yang menarik meningkatkan minat pelanggan hingga 60%
                        </p>
                    </div>

                    {{-- Form Actions --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('menus.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium rounded-lg hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Simpan Menu
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
                        <p class="font-medium mb-1">Tips Tambah Menu Baru:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Gunakan nama yang singkat namun deskriptif (max 50 karakter)</li>
                            <li>Upload foto dengan pencahayaan yang baik dan fokus pada makanan</li>
                            <li>Tulis deskripsi yang menggugah selera dan informatif</li>
                            <li>Set harga dengan kelipatan Rp 1.000 untuk kemudahan transaksi</li>
                            <li>Aktifkan menu setelah memastikan stok tersedia</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="mt-4 grid grid-cols-3 gap-3">
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Menu dengan Foto</p>
                    <p class="text-lg font-bold text-green-600 dark:text-green-400">+40%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Lebih Laris</p>
                </div>
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Dengan Deskripsi</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">+25%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Order Rate</p>
                </div>
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Harga Bulat</p>
                    <p class="text-lg font-bold text-purple-600 dark:text-purple-400">+15%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Kepuasan</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Alpine.js Component --}}
    <script>
        function menuForm() {
            return {
                imagePreview: null,
                isActive: true,

                previewImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Validasi ukuran file (2MB)
                    if (file.size > 2097152) {
                        alert('Ukuran file terlalu besar! Maksimal 2MB.');
                        event.target.value = '';
                        return;
                    }

                    // Validasi tipe file
                    if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
                        alert('Format file tidak didukung! Gunakan PNG, JPG, atau JPEG.');
                        event.target.value = '';
                        return;
                    }

                    // Tampilkan preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    }
                    reader.readAsDataURL(file);
                },

                removePreview() {
                    this.imagePreview = null;
                    this.$refs.imageInput.value = '';
                }
            }
        }
    </script>
</x-app-layout>
