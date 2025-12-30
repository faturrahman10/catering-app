@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Menu</h1>
            <a href="{{ route('menus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Menu
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
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
            <tbody>
                @foreach ($menus as $menu)
                    <tr class="text-center">
                        <td class="border px-3 py-2">
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="w-20 mx-auto">
                            @endif
                        </td>
                        <td class="border px-3 py-2">{{ $menu->name }}</td>
                        <td class="border px-3 py-2">{{ $menu->category->name }}</td>
                        <td class="border px-3 py-2 text-left">
                            {{ $menu->description ?? '-' }}
                        </td>
                        <td class="border px-3 py-2">Rp {{ number_format($menu->price) }}</td>
                        <td class="border px-3 py-2">
                            @if ($menu->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-red-600 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 space-x-2">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus menu?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
