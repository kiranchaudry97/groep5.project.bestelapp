<?php
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class TechniekerCartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'aantal' => 'required|integer|min:1',
        ]);

        $material = Material::findOrFail($request->material_id);
        $aantal = $request->aantal;

        if ($aantal > $material->voorraad) {
            return back()->with('error', 'Niet genoeg voorraad beschikbaar.');
        }

        $material->voorraad -= $aantal;
        $material->save();

        return back()->with('success', 'Materiaal toegevoegd en voorraad bijgewerkt.');
    }
}