<?php

namespace Tests\Feature;

use App\Models\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_app_post_return_201()
    {
        $newApp = [
            'app_name' => $this->faker->name,
        ];

        $response = $this->post('api/v1/apps', $newApp);

        $response->assertJsonStructure([
            'app_id',
            'app_token',
        ])->assertStatus(201);
    }

    public function test_app_get_return_200()
    {
        $app = App::create([
            'name' => $this->faker->name,
            'token' => Str::random(9),
            'user_id' => Auth::user()->id,
        ]);

        $response = $this->get("api/v1/apps/{$app->id}");

        $response->assertStatus(200);
    }
}
