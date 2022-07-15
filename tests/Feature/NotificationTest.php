<?php

namespace Tests\Feature;

use App\Models\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_web_push_notification()
    {
        $app = App::first();

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

        $response->assertJsonStructure($data)

            ->assertStatus(201);
    }
}
