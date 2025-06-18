<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Material;
use App\Models\Category;

class MigreerCategorieen extends Command
{
    protected $signature = 'migreer:categorieen';
    protected $description = 'Zet tekst-categorieën om naar category_id relaties in materials';

    public function handle()
    {
        $this->info('🚀 Start migratie van categorieën naar category_id...');

        $uniekeCats = Material::pluck('categorie')
            ->filter()
            ->map(fn($cat) => trim($cat))
            ->unique();

        foreach ($uniekeCats as $catNaam) {
            if (!$catNaam) continue;

            $category = Category::firstOrCreate(['naam' => $catNaam]);
            $aantal = Material::where('categorie', $catNaam)->update(['category_id' => $category->id]);

            $this->info("✅ '{$catNaam}' toegewezen aan {$aantal} materiaal/materialen.");
        }

        $this->info('✅ Migratie voltooid.');
    }
}