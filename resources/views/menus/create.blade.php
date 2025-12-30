@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Menu</h1>

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama Menu</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Kategori</label>
                <select name="category_id" class="w-full border px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Harga</label>
                <input type="number" name="price" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border px-3 py-2" rows="3" placeholder="Deskripsi menu (opsional)"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Gambar</label>
                <input type="file" name="image">
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="is_active" checked>
                    Aktif
                </label>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
@endsection
