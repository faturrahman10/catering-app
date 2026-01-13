<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Edit Menu
            </h2>

            <a href="{{ route('menus.index') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6">

                <form action="{{ route('menus.update', $menu) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Nama Menu
                        </label>
                        <input type="text" name="name" value="{{ old('name', $menu->name) }}"
                            class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-700" required>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Kategori
                        </label>
                        <select name="category_id"
                            class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-700" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($menu->category_id == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Harga
                        </label>
                        <input type="number" name="price" value="{{ $menu->price }}" min="0"
                            class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-700" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="3"
                            class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-700">{{ $menu->description }}</textarea>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Gambar
                        </label>
                        <input type="file" name="image" class="text-sm">

                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="h-20 mt-2 rounded border">
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" class="rounded"
                            @checked($menu->is_active)>
                        <span class="text-sm">Menu aktif</span>
                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('menus.index') }}" class="text-sm text-gray-600 hover:underline">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
