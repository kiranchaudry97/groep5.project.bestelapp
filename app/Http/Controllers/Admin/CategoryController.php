<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:100|unique:categories,naam',
        ]);

        Category::create([
            'naam' => $request->naam,
        ]);

        return back()->with('status', 'Categorie succesvol toegevoegd.');
    }

    public function create()
    {
        return view('admin.categories.create');
    }
}