<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\User;
use App\Models\WebPush;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebPushTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_web_push_settings()
    {

        $app = App::first();

        $response = $this->get("/api/v1/apps/{$app->id}/webpushes/settings");

        $response->assertJsonStructure([
            'settings' => [
                'site' => [
                    'name',
                    'address',
                    'url_icon'
                ],
                'alllow_notification' => [
                    'message_text',
                    'allow_button_text',
                    'deny_button_text'
                ],
                'welcome_notification' => [
                    'message_title',
                    'message_text',
                    'enable_url_redirect',
                    'url_redirect'
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
        $response = $this->put("/api/v1/apps/{$app->id}/webpushes/settings", $data);

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
        $response = $this->put("/api/v1/apps/{$app->id}/webpushes/settings", $data);

        $this->assertDatabaseHas('channels', [
            'channelable_type' => 'App\Models\WebPush',
            'channelable_id' => WebPush::first()->id,
            'status' => true
        ]);
    }
}
