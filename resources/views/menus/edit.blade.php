<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Menu
        </h2>
    </x-slot>

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-6">
            <div class="max-w-xl bg-white p-6 rounded shadow">
                <form action="{{ route('menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-input-label value="Nama Menu" />
                    <x-text-input name="name" class="w-full mb-4" value="{{ $menu->name }}" required />

                    <x-input-label value="Kategori" />
                    <select name="category_id" class="w-full border-gray-300 rounded mb-4">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($menu->category_id == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-label value="Harga" />
                    <x-text-input type="number" name="price" class="w-full mb-4" value="{{ $menu->price }}"
                        required />

                    <x-input-label value="Deskripsi" />
                    <textarea name="description" class="w-full border-gray-300 rounded mb-4" rows="3">{{ $menu->description }}</textarea>

                    <x-input-label value="Gambar" />
                    @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" class="w-32 mb-2 rounded">
                    @endif
                    <input type="file" name="image" class="mb-4">

                    <label class="flex items-center gap-2 mb-4">
                        <input type="checkbox" name="is_active" {{ $menu->is_active ? 'checked' : '' }}>
                        <span>Aktif</span>
                    </label>

                    <x-primary-button>
                        Update
                    </x-primary-button>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>
