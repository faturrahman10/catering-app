<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Menu') }}
        </h2>
    </x-slot>

    <div class="flex">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Content --}}
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Daftar Kategori</h3>
                <a href="{{ route('categories.create') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    + Tambah Kategori
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    {{ $category->name }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    @if ($category->is_active)
                                        <span class="text-green-600 font-semibold">Aktif</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="text-indigo-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Nonaktifkan kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">
                                            Nonaktifkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada kategori
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
