<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Material;

class CleanMaterialCategories extends Command
{
    protected $signature = 'clean:material-categories';
    protected $description = 'Verwijder overtollige spaties uit materiaalcategorieën';

    public function handle()
    {
        $this->info('Schoonmaken van categorieën gestart...');

        $materials = Material::all();
        $count = 0;

        foreach ($materials as $material) {
            $cleaned = trim(preg_replace('/\s+/', ' ', $material->categorie));

            if ($material->categorie !== $cleaned) {
                $material->categorie = $cleaned;
                $material->save();
                $count++;
            }
        }

        $this->info("Klaar. {$count} categorieën opgeschoond.");
    }
}