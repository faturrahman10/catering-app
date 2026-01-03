<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->latest()->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $categories = Category::where('is_active', true)->get();
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus');
    }
}
