<?php

namespace Database\Factories;

use App\Models\App;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message_title' => $this->faker->text,
            'message_text' => $this->faker->text,
            'app_id' => App::first()->id ?? App::factory()->create()->id,
            'channel_id' => Channel::first()->id ?? Channel::factory()->create()->id,
        ];
    }
}
