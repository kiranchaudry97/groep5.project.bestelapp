<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_technieker_dashboard_is_accessible(): void
    {
        Role::firstOrCreate(['name' => 'technieker']);
        $user = User::factory()->create();
        $user->assignRole('technieker');

        $response = $this->actingAs($user)->get('/technieker/dashboard');

        $response->assertStatus(200);
    }
}
