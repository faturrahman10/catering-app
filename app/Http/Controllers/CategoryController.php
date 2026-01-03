<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $validated['name'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validated['name'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->update([
            'is_active' => false,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dinonaktifkan');
    }
}
