<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_register_user()
    {
        $newUser = [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'company_name' => $this->faker->company,
            'phone_number' => $this->faker->phoneNumber,
            'company_address' => $this->faker->address,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/v1/users/register/', $newUser);

        $response->assertJsonStructure([
            'id',
            'email',
            'name',
            'company_name',
            'phone_number',
            'company_address',
        ])->assertStatus(201);
    }

    public function test_get_user_data()
    {
        $user = User::first();

        $response = $this->get("/api/v1/users/{$user->id}");

        $response->assertStatus(200);
    }

    public function test_user_not_found()
    {
        $response = $this->get('/api/v1/users/wrong-id');

        $response->assertExactJson([
            'error' => 'User not found'
        ])->assertStatus(404);
    }
}
