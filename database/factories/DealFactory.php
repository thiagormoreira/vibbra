<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([1,2,3]),
            'description' => $this->faker->text,
            'trade_for' => $this->faker->text,
            'location_id' => Location::factory()->create()->id,
            'urgency' => $this->faker->randomElement([1,2,3]),
            'limit_date' => $this->faker->dateTime,
            'photos' => $this->faker->imageUrl(640, 480, 'food'),
        ];
    }
}
