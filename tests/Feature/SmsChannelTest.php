<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\User;
use App\Models\Sms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmsChannelTest extends TestCase
{
    public function test_get_sms_settings()
    {
        $app = App::first();

        $response = $this->get("/api/v1/apps/{$app->id}/sms/settings");

        $response->assertJsonStructure([
            'settings' => [
                'sms_provider' => [
                    'name',
                    'login',
                    'password',
                ]
            ]
        ])->assertStatus(200);
    }

    public function test_toggle_status_channel()
    {
        $app = App::first();

        $data = [
            'status' => true
        ];
        $response = $this->put("/api/v1/apps/{$app->id}/sms/settings", $data);

        $response->assertJsonStructure([
            'previous_status',
            'current_status'
        ]);
    }

    public function test_toggle_status_channel_database_changes()
    {
        $app = App::first();

        $data = [
            'status' => true
        ];
        $this->put("/api/v1/apps/{$app->id}/sms/settings", $data);

        $this->assertDatabaseHas('channels', [
            'channelable_type' => 'App\Models\Sms',
            'channelable_id' => Sms::first()->id,
            'status' => true
        ]);
    }

    public function test_post_sms_settings()
    {

        $app = App::first();

        $data = [
            'settings' => [
                'sms_provider' => [
                    'name' => 'SmsProvider',
                    'login' => 'login',
                    'password' => 'password',
                ]
            ]
        ];

        $response = $this->post("/api/v1/apps/{$app->id}/sms/settings", $data);

        $response->assertExactJson($data);
    }
}
