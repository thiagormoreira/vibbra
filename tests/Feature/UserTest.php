<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_show()
    {
        $user = User::factory()->create();

        $response = $this->get('/api/v1/user/' . $user->id);

        $response->assertStatus(200);
    }
}
