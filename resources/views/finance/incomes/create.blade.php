<x-app-layout>
    @section('page-title', 'Tambah Pemasukan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Tambah Pemasukan Lain
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Catat pemasukan selain dari penjualan orders
                    </p>
                </div>

                <a href="{{ route('finance.incomes.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form Card dengan Alpine.js --}}
        <div class="max-w-4xl mx-auto" x-data="incomeForm()">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                <form action="{{ route('finance.incomes.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-6">
                    @csrf

                    {{-- Icon Dekoratif --}}
                    <div class="flex justify-center pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-40 h-40 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Tanggal Pemasukan --}}
                    <div>
                        <x-input-label for="income_date" value="Tanggal Pemasukan *" />
                        <x-text-input id="income_date" name="income_date" type="date" class="mt-1 block w-full"
                            :value="old('income_date', date('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('income_date')" />
                    </div>

                    {{-- Items Section --}}
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pemasukan</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400"
                                x-text="`${items.length} item`"></span>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 relative">
                                    {{-- Remove Button --}}
                                    <button type="button" @click="removeItem(index)" x-show="items.length > 1"
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        {{-- Sumber --}}
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Sumber <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="item.source"
                                                :name="`items[${index}][source]`" required
                                                placeholder="Contoh: Sewa Tempat"
                                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        {{-- Deskripsi --}}
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Deskripsi <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="item.description"
                                                :name="`items[${index}][description]`" required
                                                placeholder="Detail pemasukan"
                                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        {{-- Jumlah --}}
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Jumlah (Rp) <span class="text-red-500">*</span>
                                            </label>
                                            <input type="number" x-model.number="item.amount"
                                                :name="`items[${index}][amount]`" required min="1" step="1"
                                                @input="calculateTotal()" placeholder="500000"
                                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Add Item Button --}}
                        <button type="button" @click="addItem()"
                            class="mt-4 w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg 
                                   text-gray-600 dark:text-gray-400 hover:border-green-500 hover:text-green-600 dark:hover:text-green-400
                                   transition-colors duration-150 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="font-medium">Tambah Item Pemasukan</span>
                        </button>

                        {{-- Total --}}
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">Total Pemasukan:</span>
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400"
                                x-text="formatRupiah(totalAmount)"></span>
                            <input type="hidden" name="total_amount" :value="totalAmount">
                        </div>
                    </div>

                    {{-- Upload Bukti --}}
                    <div>
                        <x-input-label for="proof_image" value="Upload Bukti Transfer/Nota (Opsional)" />

                        {{-- Preview atau Upload Area --}}
                        <div class="mt-1">
                            <div x-show="imagePreview" x-cloak class="relative">
                                <img :src="imagePreview" alt="Preview"
                                    class="w-full h-auto max-h-[600px] object-contain rounded-lg border-2 border-green-500 bg-gray-100 dark:bg-gray-800">
                                <div
                                    class="absolute inset-0 bg-black/50 rounded-lg opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                    <button type="button" @click="$refs.proofInput.click()"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-900 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
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

                            <label x-show="!imagePreview" for="proof_image"
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
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG atau JPEG (MAX. 2MB)
                                    </p>
                                </div>
                            </label>

                            <input id="proof_image" name="proof_image" type="file" class="hidden"
                                accept="image/png,image/jpeg,image/jpg" x-ref="proofInput"
                                @change="previewImage($event)" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('proof_image')" />
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <x-input-label for="notes" value="Catatan (Opsional)" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            placeholder="Catatan tambahan tentang pemasukanini...">{{ old('notes') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>
                    {{-- Form Actions --}}
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('finance.incomes.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium rounded-lg hover:shadow-lg hover:shadow-green-500/50 hover:scale-105 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Pemasukan
                        </button>
                    </div>

                </form>
            </div>

            {{-- Info Card --}}
            <div
                class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-green-800 dark:text-green-300">
                        <p class="font-medium mb-1">Catatan Pemasukan Lain:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Pemasukan ini BUKAN dari penjualan orders (sudah tercatat otomatis)</li>
                            <li>Contoh: Sewa tempat, jasa konsultasi, pendapatan lain-lain</li>
                            <li>Simpan bukti transfer untuk dokumentasi</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Alpine.js Component --}}
    <script>
        function incomeForm() {
            return {
                items: [{
                    source: '',
                    description: '',
                    amount: 0
                }],
                totalAmount: 0,
                imagePreview: null,

                addItem() {
                    this.items.push({
                        source: '',
                        description: '',
                        amount: 0
                    });
                },

                removeItem(index) {
                    this.items.splice(index, 1);
                    this.calculateTotal();
                },

                calculateTotal() {
                    this.totalAmount = this.items.reduce((sum, item) => sum + (parseInt(item.amount) || 0), 0);
                },

                formatRupiah(amount) {
                    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },

                previewImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (file.size > 2097152) {
                        alert('Ukuran file terlalu besar! Maksimal 2MB.');
                        event.target.value = '';
                        return;
                    }

                    if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
                        alert('Format file tidak didukung! Gunakan PNG, JPG, atau JPEG.');
                        event.target.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    }
                    reader.readAsDataURL(file);
                },

                removePreview() {
                    this.imagePreview = null;
                    this.$refs.proofInput.value = '';
                }
            }
        }
    </script>
</x-app-layout>
