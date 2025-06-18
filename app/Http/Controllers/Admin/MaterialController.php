<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use Normalizer;

class MaterialController extends Controller
{
    /**
     * Toon overzicht van alle materialen met zoek- en filteropties.
     */
    public function index(Request $request)
    {
        $query = Material::query();

        // 🔍 Zoek op naam (case-insensitive)
        if ($request->filled('search')) {
            $zoekterm = strtolower(trim($request->search));
            $query->whereRaw('LOWER(naam) LIKE ?', ['%' . $zoekterm . '%']);
        }

        // 📂 Filter op categorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // 📄 Materialen ophalen
        $materials = $query->orderBy('naam')->get();

        // 📦 Categorieën uit de category-tabel
        $allCategories = Category::orderBy('naam')->pluck('naam');

        return view('admin.materials.index', compact('materials', 'allCategories'));
    }

    /**
     * Formulier voor nieuw materiaal.
     */
    public function create()
    {
        $allCategories = Category::orderBy('naam')->pluck('naam');
        return view('admin.materials.create', compact('allCategories'));
    }

    /**
     * Materiaal opslaan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'voorraad' => 'required|integer|min:0',
            'beschrijving' => 'nullable|string|max:1000',
        ]);

        Material::create($request->only(['naam', 'categorie', 'voorraad', 'beschrijving']));

        return redirect()->route('admin.materials.index')->with('status', 'Materiaal toegevoegd.');
    }

    /**
     * Materiaal bewerken.
     */
    public function edit(Material $material)
    {
        $allCategories = Category::orderBy('naam')->pluck('naam');
        return view('admin.materials.edit', compact('material', 'allCategories'));
    }

    /**
     * Update bewerking opslaan.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'voorraad' => 'required|integer|min:0',
            'beschrijving' => 'nullable|string|max:1000',
        ]);

        $material->update($request->only(['naam', 'categorie', 'voorraad', 'beschrijving']));

        return redirect()->route('admin.materials.index')->with('status', 'Materiaal bijgewerkt.');
    }

    /**
     * Materiaal verwijderen.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('admin.materials.index')->with('status', 'Materiaal verwijderd.');
    }

    /**
     * Unieke categorieën ophalen — alleen gebruikt als fallback.
     */
    protected function getUniekeCategorieën()
    {
        return Material::pluck('categorie')
            ->filter()
            ->map(fn($cat) => normalizer_normalize(trim($cat), \Normalizer::FORM_C))
            ->unique()
            ->sort()
            ->values();
    }
}