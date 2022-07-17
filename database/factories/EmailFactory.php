<?php

namespace Database\Factories;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'smtp_name' => $this->faker->domainName,
            'smtp_port' => $this->faker->numberBetween(1, 65535),
            'smtp_login' => $this->faker->userName,
            'smtp_password' => $this->faker->password,
            'sender_name' => $this->faker->name,
            'sender_email' => $this->faker->email,
            'app_id' => App::first()?->id ?? App::factory()->create()->id,
        ];
    }
}
