@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Edit Menu</h1>

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Nama Menu</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Kategori</label>
                <select name="category_id" class="w-full border px-3 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($menu->category_id == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Harga</label>
                <input type="number" name="price" value="{{ $menu->price }}" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border px-3 py-2">{{ old('description', $menu->description) }}</textarea>
            </div>


            <div class="mb-4">
                <label class="block mb-1">Gambar</label>
                @if ($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" class="w-32 mb-2">
                @endif
                <input type="file" name="image">
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="is_active" {{ $menu->is_active ? 'checked' : '' }}>
                    Aktif
                </label>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
@endsection
