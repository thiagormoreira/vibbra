<?php

namespace Database\Factories;

use App\Models\App;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebPush>
 */
class WebPushFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => $this->faker->company,
            'site_address' => $this->faker->url,
            'site_url_icon' => $this->faker->imageUrl,

            'allow_notification_message_text' => $this->faker->text,
            'allow_notification_allow_button_text' => $this->faker->text,
            'allow_notification_deny_button_text' => $this->faker->text,

            'welcome_notification_message_title' => $this->faker->text,
            'welcome_notification_message_text' => $this->faker->text,
            'welcome_notification_enable_url_redirect' => $this->faker->boolean,
            'welcome_notification_url_redirect' => $this->faker->url,

            'app_id' => App::first()->id,
        ];
    }
}
