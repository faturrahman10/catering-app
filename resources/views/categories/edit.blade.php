@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="is_active" {{ $category->is_active ? 'checked' : '' }}>
                    Aktif
                </label>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
@endsection
