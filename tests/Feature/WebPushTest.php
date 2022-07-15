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
                'allow_notification' => [
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

    public function test_post_web_push_settings()
    {

        $app = App::first();

        $data = [
            'settings' => [
                'site' => [
                    'name' => 'Test Site',
                    'address' => 'http://test.com',
                    'url_icon' => 'http://test.com/icon.png'
                ],
                'allow_notification' => [
                    'message_text' => 'New Test Message Text',
                    'allow_button_text' => 'New Test Allow Button Text',
                    'deny_button_text' => 'New Test Deny Button Text'
                ],
                'welcome_notification' => [
                    'message_title' => 'New Test Message Title',
                    'message_text' => 'New Test Message Text',
                    'enable_url_redirect' => true,
                    'url_redirect' => 'http://test.com'
                ]
            ]
        ];

        $response = $this->post("/api/v1/apps/{$app->id}/webpushes/settings", $data);

        $response->assertExactJson($data);
    }
}
