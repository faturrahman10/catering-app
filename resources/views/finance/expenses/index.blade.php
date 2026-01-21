<x-app-layout>
    @section('page-title', 'Keuangan - Pengeluaran')

    {{-- Page Content --}}
    <div class="p-4 md:p-6 lg:p-8">

        {{-- Tabs Navigation --}}
        <div class="mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8 overflow-x-auto">
                    <a href="{{ route('finance.index') }}"
                        class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fas fa-chart-line mr-2"></i>Dashboard
                    </a>

                    <a href="{{ route('finance.expenses.index') }}"
                        class="border-indigo-500 text-indigo-600 dark:text-indigo-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fas fa-minus-circle mr-2"></i>Pengeluaran
                    </a>

                    <a href="{{ route('finance.incomes.index') }}"
                        class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fas fa-plus-circle mr-2"></i>Pemasukan Lain
                    </a>

                    <a href="{{ route('finance.sales') }}"
                        class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fas fa-shopping-cart mr-2"></i>Penjualan Orders
                    </a>
                </nav>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header Actions --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Pengeluaran</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total: Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('finance.expenses.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-lg text-sm font-medium hover:shadow-lg hover:shadow-red-500/50 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengeluaran
            </a>
        </div>

        {{-- Filters --}}
        <div class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-4">
            <form method="GET" action="{{ route('finance.expenses.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Dari Tanggal
                    </label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Sampai Tanggal
                    </label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>

                <div class="flex-1 min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kategori
                    </label>
                    <select name="category"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                    Filter
                </button>

                <a href="{{ route('finance.expenses.index') }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg transition">
                    Reset
                </a>
            </form>
        </div>

        {{-- Table Desktop --}}
        <div class="hidden md:block bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Detail Items
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Total
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Dibuat Oleh
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($expenses as $expense)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $expense->expense_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <div class="space-y-1">
                                        @foreach ($expense->items as $item)
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                                    {{ $item['category'] }}
                                                </span>
                                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $item['description'] }}</span>
                                                <span class="text-xs font-semibold text-gray-900 dark:text-white">
                                                    Rp {{ number_format($item['amount'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600 dark:text-red-400">
                                    Rp {{ number_format($expense->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $expense->creator->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('finance.expenses.show', $expense) }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                            Detail
                                        </a>
                                        <a href="{{ route('finance.expenses.edit', $expense) }}"
                                            class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900">
                                            Edit
                                        </a>
                                        <form action="{{ route('finance.expenses.destroy', $expense) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data pengeluaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($expenses->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $expenses->links() }}
                </div>
            @endif
        </div>

        {{-- Cards Mobile --}}
        <div class="md:hidden space-y-4">
            @forelse ($expenses as $expense)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $expense->expense_date->format('d M Y') }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ count($expense->items) }} item
                            </p>
                        </div>
                        <span class="text-lg font-bold text-red-600 dark:text-red-400">
                            Rp {{ number_format($expense->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="space-y-2 mb-3">
                        @foreach ($expense->items as $item)
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-2">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                        {{ $item['category'] }}
                                    </span>
                                    <span class="text-xs font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($item['amount'], 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $item['description'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $expense->creator->name ?? '-' }}
                        </span>
                        <div class="flex gap-2">
                            <a href="{{ route('finance.expenses.show', $expense) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-lg text-xs font-medium hover:bg-indigo-200 dark:hover:bg-indigo-900/50">
                                Detail
                            </a>
                            <a href="{{ route('finance.expenses.edit', $expense) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-lg text-xs font-medium hover:bg-yellow-200 dark:hover:bg-yellow-900/50">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 font-medium">Tidak ada data pengeluaran</p>
                </div>
            @endforelse

            {{-- Pagination Mobile --}}
            @if ($expenses->hasPages())
                <div class="mt-4">
                    {{ $expenses->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>