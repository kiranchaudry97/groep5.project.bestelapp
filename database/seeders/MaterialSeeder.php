<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 🧰 Bevestigingsmateriaal
            ['naam' => 'Bout: M6', 'categorie' => '🧰 Bevestigingsmateriaal'],
            ['naam' => 'Bout: M8', 'categorie' => '🧰 Bevestigingsmateriaal'],
            ['naam' => 'Moer: Zeskantmoer', 'categorie' => '🧰 Bevestigingsmateriaal'],
            ['naam' => 'Ring: Sluitring', 'categorie' => '🧰 Bevestigingsmateriaal'],
            ['naam' => 'Chemisch anker (bv. Hilti HIT)', 'categorie' => '🧰 Bevestigingsmateriaal'],

            // 👷‍♂ PBM
            ['naam' => 'Veiligheidshelm (met kinband)', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'Oordoppen', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'Gehoorkappen', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'Veiligheidsbril', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'Gelaatsscherm', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'Gasdetectiemeter', 'categorie' => '👷‍♂ PBM'],
            ['naam' => 'EHBO-kit', 'categorie' => '👷‍♂ PBM'],

            // 🔧 Gereedschap
            ['naam' => 'Dopsleutelset: metrisch', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Dopsleutelset: inch', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Accuboormachine', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Schroevendraaier: plat', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Combinatietang', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Waterpas', 'categorie' => '🔧 Gereedschap'],
            ['naam' => 'Momentsleutel', 'categorie' => '🔧 Gereedschap'],

            // ⚙ Technische onderhoudsmaterialen
            ['naam' => 'Smeervet: EP2', 'categorie' => '⚙ Technische onderhoudsmaterialen'],
            ['naam' => 'O-ring: klein', 'categorie' => '⚙ Technische onderhoudsmaterialen'],
            ['naam' => 'PTFE tape', 'categorie' => '⚙ Technische onderhoudsmaterialen'],
            ['naam' => 'Loctite', 'categorie' => '⚙ Technische onderhoudsmaterialen'],
            ['naam' => 'PVC-fitting', 'categorie' => '⚙ Technische onderhoudsmaterialen'],
            ['naam' => 'V-snaar', 'categorie' => '⚙ Technische onderhoudsmaterialen'],

            // 🛠 Riolering tools
            ['naam' => 'Putdekselhaak', 'categorie' => '🛠 Riolering tools'],
            ['naam' => 'Inspectiecamera', 'categorie' => '🛠 Riolering tools'],
            ['naam' => 'Dompelpomp', 'categorie' => '🛠 Riolering tools'],
            ['naam' => 'Rioolstop', 'categorie' => '🛠 Riolering tools'],
            ['naam' => 'Niveaumeter: radar', 'categorie' => '🛠 Riolering tools'],

            // 📦 Diversen / Verbruiksgoederen
            ['naam' => 'Tie-wrap', 'categorie' => '📦 Diversen / Verbruiksgoederen'],
            ['naam' => 'Kabelschoen', 'categorie' => '📦 Diversen / Verbruiksgoederen'],
            ['naam' => 'WD-40', 'categorie' => '📦 Diversen / Verbruiksgoederen'],
            ['naam' => 'Markeringstape', 'categorie' => '📦 Diversen / Verbruiksgoederen'],
            ['naam' => 'Accu', 'categorie' => '📦 Diversen / Verbruiksgoederen'],
        ];

        foreach ($items as $item) {
            Material::firstOrCreate(
                ['naam' => $item['naam'], 'categorie' => $item['categorie']],
                ['voorraad' => 100]
            );
        }
    }
}