<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'accepted' => $this->faker->boolean,
            'value' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->text,
        ];
    }
}
