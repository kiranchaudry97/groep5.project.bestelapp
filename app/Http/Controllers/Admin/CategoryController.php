<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Sla een nieuwe categorie op.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:100|unique:categories,naam',
        ]);

        // Maak de categorie aan
        Category::create([
            'naam' => $request->naam,
        ]);

        // Redirect naar het materiaal-aanmaakformulier met geselecteerde categorie
        return redirect()
            ->route('admin.materials.create', ['selected' => $request->naam])
            ->with('status', 'Categorie succesvol toegevoegd.');
    }
}