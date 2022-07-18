<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\Email;
use App\Models\User;
use App\Models\WebPush;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmailChannelTest extends TestCase
{
    public function test_get_email_settings()
    {
        $app = App::first();

        $response = $this->get("/api/v1/apps/{$app->id}/emails/settings");

        $response->assertJsonStructure([
            'settings' => [
                'server' => [
                    'smtp_name',
                    'smtp_port',
                    'user_login',
                    'user_password'
                ],
                'sender' => [
                    'name',
                    'email',
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
        $response = $this->put("/api/v1/apps/{$app->id}/emails/settings", $data);

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
        $this->put("/api/v1/apps/{$app->id}/emails/settings", $data);

        $this->assertDatabaseHas('channels', [
            'channelable_type' => 'App\Models\Email',
            'channelable_id' => Email::first()->id,
            'status' => true
        ]);
    }

    public function test_post_email_settings()
    {

        $app = App::first();

        $data = [
            'settings' => [
                'server' => [
                    'smtp_name' => 'smtp.gmail.com',
                    'smtp_port' => 587,
                    'user_login' => 'login',
                    'user_password' => 'password'
                ],
                'sender' => [
                    'name' => 'Sender Name',
                    'email' => 'sender@email.com',
                ],
                'email_templates' => [
                    [
                        'name' => 'template_name 1',
                        'uri' => 'template_uri 1',
                    ],
                    [
                        'name' => 'template_name 2',
                        'uri' => 'template_uri 2',
                    ],
                    [
                        'name' => 'template_name 3',
                        'uri' => 'template_uri 3',
                    ]
                ]
            ]
        ];

        $response = $this->post("/api/v1/apps/{$app->id}/emails/settings", $data);

        $response->assertExactJson($data);
    }
}
