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
        // ✅ Rollen aanmaken als ze nog niet bestaan
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $techRole  = Role::firstOrCreate(['name' => 'technieker']);

        // ✅ Bestaande gebruikers verwijderen voor herstart (optioneel)
        User::where('email', 'tech@aquafin.be')->delete();
        User::where('email', 'admin@aquafin.be')->delete();

        // ✅ Technieker aanmaken
        $tech = User::create([
            'name' => 'Technieker Gebruiker',
            'email' => 'tech@aquafin.be',
            'password' => Hash::make('tech123'),
            'email_verified_at' => now(),
        ]);
        $tech->assignRole($techRole);

        // ✅ Admin aanmaken
        $admin = User::create([
            'name' => 'Admin Gebruiker',
            'email' => 'admin@aquafin.be',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($adminRole);

        // ✅ Console feedback
        $this->command->info('✅ Technieker: tech@aquafin.be / tech123');
        $this->command->info('✅ Admin: admin@aquafin.be / admin123');
    }
}