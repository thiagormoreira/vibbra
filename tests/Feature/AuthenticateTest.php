<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function test_login_success()
    {
        $user = User::factory()->create();
        $response = $this->post('/api/v1/login',
            [
                'email' => $user->email,
                'password' => 'password'
            ]
        );

        $response->assertJsonStructure(
            [
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                ]
            ]
        )->assertStatus(200);
    }

    public function test_login_fail()
    {
        $user = User::factory()->create();
        $response = $this->post('/api/v1/login',
            [
                'email' => $user->email,
                'password' => 'wrong_password'
            ]
        );

        $response->assertJsonStructure(
            [
                'error'
            ]
        )->assertStatus(401);
    }
}
