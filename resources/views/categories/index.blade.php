@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Kategori Menu</h1>
            <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Kategori
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2 w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-3 py-2">{{ $category->name }}</td>
                        <td class="border px-3 py-2 text-center">
                            @if ($category->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-red-600 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 text-center space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus kategori?')">
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
