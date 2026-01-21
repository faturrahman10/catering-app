<x-app-layout>
    @section('page-title', 'Detail Pemasukan')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Detail Pemasukan Lain
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
                        Informasi lengkap pemasukan bisnis
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('finance.incomes.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 
                              bg-white dark:bg-gray-800 
                              border border-gray-300 dark:border-gray-700
                              text-gray-700 dark:text-gray-300 
                              rounded-lg text-sm font-medium
                              hover:bg-gray-50 dark:hover:bg-gray-700
                              transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>

                    <a href="{{ route('finance.incomes.edit', $income) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 
                              bg-yellow-500 dark:bg-yellow-600 
                              text-white 
                              rounded-lg text-sm font-medium
                              hover:bg-yellow-600 dark:hover:bg-yellow-700
                              transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto space-y-6">

            {{-- Summary Card --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    {{-- Icon --}}
                    <div class="flex-shrink-0">
                        <div
                            class="w-32 h-32 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                            Pemasukan Lain #{{ $income->id }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            {{ $income->income_date->format('d F Y') }}
                        </p>

                        <div class="space-y-3">
                            {{-- Total Amount --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Pemasukan</p>
                                    <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($income->total_amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Items Count --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Item</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ count($income->items) }} item
                                    </p>
                                </div>
                            </div>

                            {{-- Created By --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Oleh</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $income->creator->name ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Items Detail --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Detail Item Pemasukan
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($income->items as $index => $item)
                            <div
                                class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                                {{ $item['source'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($item['amount'], 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Total Footer --}}
                    <div
                        class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Total:</span>
                        <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                            Rp {{ number_format($income->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Proof & Notes --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Proof --}}
                @if ($income->proof_image)
                    <div
                        class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Bukti Transfer/Nota</h3>
                        <img src="{{ asset('storage/' . $income->proof_image) }}" alt="Proof"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600">
                    </div>
                @endif

                {{-- Notes --}}
                @if ($income->notes)
                    <div
                        class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Catatan</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $income->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Metadata --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Tambahan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Dibuat</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $income->created_at->format('d F Y H:i') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Terakhir Diupdate</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $income->updated_at->format('d F Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <form action="{{ route('finance.incomes.destroy', $income) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus pemasukan ini? Data yang dihapus tidak dapat dikembalikan.')"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>
