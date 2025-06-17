<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class MateriaalBestellingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function technieker_kan_materiaal_bestellen_en_voorraad_daalt()
    {

        Role::firstOrCreate(['name' => 'technieker']);

        $technieker = User::factory()->create();
        $technieker->assignRole('technieker');

        $material = Material::create([
            'naam' => 'PBM Helm',
            'categorie' => 'PBM',
            'voorraad' => 10,
        ]);

        $response = $this->actingAs($technieker)->post(route('technieker.cart.add'), [
            'material_id' => $material->id,
            'aantal' => 3,
        ]);

        $material->refresh();
        $this->assertEquals(7, $material->voorraad);
        $response->assertSessionHas('success');
    }
}
