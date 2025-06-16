<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Material;

class CleanupMaterials extends Command
{
    protected $signature = 'materials:cleanup';
    protected $description = 'Verwijder duplicaten en ruim categorieën op voor materialen';

    public function handle()
    {
        $this->info('🧹 Start met opschonen...');

        // 1. Duplicaten verwijderen
        $names = Material::select('naam')
            ->groupBy('naam')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('naam');

        $removed = 0;

        foreach ($names as $naam) {
            $duplicates = Material::where('naam', $naam)->get();
            $duplicates->shift(); // behoud 1
            foreach ($duplicates as $d) {
                $d->delete();
                $removed++;
            }
        }

        $this->info("✅ $removed duplicaten verwijderd.");

        // 2. Categorieën opschonen
        $materials = Material::all();
        $updated = 0;

        foreach ($materials as $material) {
            $clean = trim(preg_replace('/\s+/', ' ', $material->categorie));
            if ($material->categorie !== $clean) {
                $material->categorie = $clean;
                $material->save();
                $updated++;
            }
        }

        $this->info("✅ $updated categorieën opgeschoond.");

        // 3. Check op ontbrekende afbeelding (optioneel logging)
        $imagePath = public_path('images/categorieën');
        $missing = 0;

        foreach ($materials as $material) {
            $key = strtolower(trim($material->categorie));
            $filename = $imagePath . '/' . $key . '.jpg';
            if (!file_exists($filename)) {
                $this->warn("⚠ Afbeelding ontbreekt voor categorie: '$material->categorie'");
                $missing++;
            }
        }

        $this->info("🔍 $missing categorieën zonder afbeelding.");
        $this->info('🎉 Opschonen voltooid!');
    }
}