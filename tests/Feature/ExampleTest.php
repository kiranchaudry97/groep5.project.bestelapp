<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_redirects_correctly(): void
    {
        Role::firstOrCreate(['name' => 'technieker']);
        $user = User::factory()->create();
        $user->assignRole('technieker');

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/technieker/dashboard');
    }
}
