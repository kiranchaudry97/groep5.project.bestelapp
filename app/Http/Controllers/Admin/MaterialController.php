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
     * Haal alle unieke categorieën op uit de Category-tabel.
     */
    protected function getUniekeCategorieën()
    {
        return Category::orderBy('naam')->pluck('naam');
    }

    /**
     * Toon overzicht van alle materialen, met optionele filtering op categorie.
     */
    public function index(Request $request)
    {
        $query = Material::query();

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        $materials = $query->orderBy('naam')->get();
        $allCategories = $this->getUniekeCategorieën();

        return view('admin.materials.index', compact('materials', 'allCategories'));
    }

    /**
     * Toon het formulier om een nieuw materiaal toe te voegen.
     */
    public function create()
    {
        $allCategories = $this->getUniekeCategorieën();
        return view('admin.materials.create', compact('allCategories'));
    }

    /**
     * Verwerk het aanmaken van een nieuw materiaal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'categorie_bestaand' => 'nullable|string|max:255',
            'categorie_nieuw' => 'nullable|string|max:255',
            'voorraad' => 'required|integer|min:0',
            'beschrijving' => 'nullable|string|max:1000',
        ]);

        // 🔁 Gebruik nieuwe of bestaande categorie
        $categorie = $request->categorie_nieuw ?: $request->categorie_bestaand;

        // Indien nieuwe categorie is ingevuld, voeg toe aan Category-tabel
        if ($request->filled('categorie_nieuw')) {
            Category::firstOrCreate(['naam' => $categorie]);
        }

        Material::create([
            'naam' => $request->naam,
            'categorie' => $categorie,
            'voorraad' => $request->voorraad,
            'beschrijving' => $request->beschrijving,
        ]);

        return redirect()->route('admin.materials.index')->with('status', 'Materiaal toegevoegd.');
    }

    /**
     * Toon details van een materiaal.
     */
    public function show(Material $material)
    {
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Toon formulier om een materiaal te bewerken.
     */
    public function edit(Material $material)
    {
        $allCategories = $this->getUniekeCategorieën();
        return view('admin.materials.edit', compact('material', 'allCategories'));
    }

    /**
     * Verwerk het bijwerken van een materiaal.
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