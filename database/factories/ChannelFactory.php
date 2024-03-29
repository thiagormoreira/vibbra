<?php

namespace Database\Factories;

use App\Models\App;
use App\Models\WebPush;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'channelable_id' => WebPush::first()?->id ?? WebPush::factory()->create()->id,
            'channelable_type' => WebPush::class,
            'app_id' => App::first()?->id ?? App::factory()->create()->id,
        ];
    }
}
