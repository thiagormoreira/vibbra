<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    public function test_post_web_push_notification_on_actived_channel()
    {
        $app = App::first();

        $channel = $app->channel()->first();
        $channel->status = true;
        $channel->save();

        $data = [
            "audience_segments" => [
                "audience_segment1",
                "Audience_segment2",
                "audience_segment3"
            ],
            "message_title" => "Notification Title",
            "message_text" => "Notification Text",
            "icon_url" => "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png",
            "redirect_url" => "https://www.google.com/",
            "app_id" => $app->id,
        ];

        $response = $this->post("/api/v1/apps/{$app->id}/webpushes/notification", $data);

        $response->assertSimilarJson($data)
            ->assertStatus(201);
    }

    public function test_post_web_push_notification_on_deatived_channel()
    {
        $app = App::first();

        $channel = $app->channel()->first();
        $channel->status = false;
        $channel->save();

        $data = [
            "audience_segments" => [
                "audience_segment1",
                "Audience_segment2",
                "audience_segment3"
            ],
            "message_title" => "Notification Title",
            "message_text" => "Notification Text",
            "icon_url" => "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png",
            "redirect_url" => "https://www.google.com/",
            "app_id" => $app->id,
        ];

        $response = $this->post("/api/v1/apps/{$app->id}/webpushes/notification", $data);

        $response->assertExactJson(['error' => 'Channel is not active'])
            ->assertStatus(401);
    }

    public function test_get_notifications_history()
    {
        $app = App::first();

        $response = $this->get("/api/v1/apps/{$app->id}/webpushes/notifications");

        $response->assertJsonStructure([
            'notifications' => [
                '*' => [
                    'notification_id',
                    'send_date',
                ]
            ]
        ])->assertStatus(200);
    }

    public function test_show_notification_details()
    {
        $app = App::first();

        $notification = Notification::first();

        $response = $this->get("/api/v1/apps/{$app->id}/webpushes/notifications/{$notification->id}");

        $response->assertJsonStructure([
            "audience_segments" => [],
            "message_title",
            "message_text",
            "icon_url",
            "redirect_url",
            "app_id",
        ])->assertStatus(200);
    }
}
