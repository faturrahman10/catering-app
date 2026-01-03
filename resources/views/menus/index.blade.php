<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menu') }}
            </h2>

            <a href="{{ route('menus.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Tambah Menu
            </a>
        </div>
    </x-slot>

    <div class="flex">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Content --}}
        <div class="flex-1 p-6">
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100 text-sm">
                        <tr>
                            <th class="border px-3 py-2">Gambar</th>
                            <th class="border px-3 py-2">Nama</th>
                            <th class="border px-3 py-2">Deskripsi</th>
                            <th class="border px-3 py-2">Kategori</th>
                            <th class="border px-3 py-2">Harga</th>
                            <th class="border px-3 py-2">Status</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($menus as $menu)
                            <tr class="text-center hover:bg-gray-50">
                                <td class="border px-3 py-2">
                                    @if ($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" class="w-20 mx-auto rounded">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="border px-3 py-2 font-medium">
                                    {{ $menu->name }}
                                </td>

                                <td class="border px-3 py-2 text-left">
                                    {{ $menu->description ?? '-' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $menu->category->name }}
                                </td>

                                <td class="border px-3 py-2">
                                    Rp {{ number_format($menu->price) }}
                                </td>

                                <td class="border px-3 py-2">
                                    @if ($menu->is_active)
                                        <span class="text-green-600 font-semibold">Aktif</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="border px-3 py-2 space-x-2">
                                    <a href="{{ route('menus.edit', $menu) }}" class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus menu?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    Belum ada menu
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
