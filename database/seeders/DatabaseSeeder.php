<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run all seeders for the application.
     */
    public function run(): void
    {
        $this->call([
            //  Rollen en testgebruikers
            RoleAndUserSeeder::class,

            // Materiaallijst
            MaterialSeeder::class,
        ]);
    }
}
