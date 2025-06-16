<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Rollen aanmaken als ze nog niet bestaan
        $techRole = Role::firstOrCreate(['name' => 'technieker']);

        // Bestaande gebruiker verwijderen (optioneel maar handig bij herstart)
        User::where('email', 'tech@aquafin.be')->delete();

        // Technieker opnieuw aanmaken
        $tech = User::create([
            'name' => 'Technieker Gebruiker',
            'email' => 'tech@aquafin.be',
            'password' => Hash::make('tech123'),
        ]);

        // Rol toewijzen
        $tech->assignRole($techRole);

        $this->command->info('✅ Technieker opnieuw aangemaakt: tech@aquafin.be / tech123');
    }
}