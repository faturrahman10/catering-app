<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class LandingPageController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->with([
                'menus' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->get();

        $menus = Menu::where('is_active', true)->latest()->limit(6)->get();

        return view('welcome', compact('categories', 'menus'));
    }
}
