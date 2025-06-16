<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Normalizer;

class MaterialController extends Controller
{
    /**
     * Toon overzicht van alle materialen (optioneel gefilterd op categorie).
     */
    public function index(Request $request)
    {
        $query = Material::query();

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        $materials = $query->orderBy('naam')->get();

        $allCategories = Material::pluck('categorie')
            ->map(fn($cat) => normalizer_normalize(trim(preg_replace('/\s+/', ' ', $cat)), \Normalizer::FORM_C))
            ->unique()
            ->sort()
            ->values();

        return view('admin.materials.index', compact('materials', 'allCategories'));
    }

    /**
     * Toon het formulier om een nieuw materiaal toe te voegen.
     */
    public function create()
    {
        $allCategories = Material::pluck('categorie')
            ->map(fn($cat) => normalizer_normalize(trim(preg_replace('/\s+/', ' ', $cat)), \Normalizer::FORM_C))
            ->unique()
            ->sort()
            ->values();

        return view('admin.materials.create', compact('allCategories'));
    }

    /**
     * Verwerk het aanmaken van een nieuw materiaal.
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
     * Toon een specifieke materiaalrecord.
     */
    public function show(Material $material)
    {
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Toon het formulier om materiaal te bewerken.
     */
    public function edit(Material $material)
    {
        $allCategories = Material::pluck('categorie')
            ->map(fn($cat) => normalizer_normalize(trim(preg_replace('/\s+/', ' ', $cat)), \Normalizer::FORM_C))
            ->unique()
            ->sort()
            ->values();

        return view('admin.materials.edit', compact('material', 'allCategories'));
    }

    /**
     * Verwerk het bijwerken van een bestaand materiaal.
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
     * Verwijder een materiaal uit de database.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('admin.materials.index')->with('status', 'Materiaal verwijderd.');
    }
}