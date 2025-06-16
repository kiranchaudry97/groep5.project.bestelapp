<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Material;

class CleanCategoryMapping extends Command
{
    protected $signature = 'clean:category-mapping';
    protected $description = 'Corrigeer veelvoorkomende inconsistenties in materiaalcategorieën';

    public function handle()
    {
        $this->info('Start met categorie mapping cleanup...');

        $mappings = [
            '👷‍♂ PBM' => '👷‍♂ PBM',
            '🔧 Gereedschap' => '🔧 Gereedschap',
            '🧰 Bevestigingsmateriaal' => '🧰 Bevestigingsmateriaal',
            '⚙ Technische onderhoudsmaterialen' => '⚙ Technische onderhoudsmaterialen',
            '🛠 Riolering tools' => '🛠 Riolering tools',
            '📦 Diversen' => '📦 Diversen / Verbruiksgoederen',
        ];

        $count = 0;

        foreach ($mappings as $incorrect => $correct) {
            $materials = Material::where('categorie', $incorrect)->get();

            foreach ($materials as $material) {
                $material->categorie = $correct;
                $material->save();
                $count++;
            }
        }

        $this->info("Mapping voltooid. {$count} categorieën bijgewerkt.");
    }
}