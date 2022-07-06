<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/api/v1');

        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Welcome to API',
            'status' => 'success',
        ]);
    }
}
