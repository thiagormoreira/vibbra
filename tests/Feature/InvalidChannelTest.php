<?php

namespace Tests\Feature;

use App\Models\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvalidChannelTest extends TestCase
{
    public function test_invalid_channel()
    {
        $app = App::first();

        $response = $this->get("/api/v1/apps/{$app->id}/invalid-channel/settings");

        $response->assertExactJson(['message' => 'Invalid channel'])
            ->assertStatus(404);
    }
}
