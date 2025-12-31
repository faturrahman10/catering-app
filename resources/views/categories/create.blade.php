@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Kategori</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
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
