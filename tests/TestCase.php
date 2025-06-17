<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoTest extends TestCase
{
    /**
     * Test of de homepage bereikbaar is.
     */
    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302); // Bijv. redirect naar login
    }
}