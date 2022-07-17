<?php

namespace Database\Factories;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sms>
 */
class SmsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'provider_name' => $this->faker->domainName,
            'provider_login' => $this->faker->userName,
            'provider_password' => $this->faker->password,
            'app_id' => App::first()?->id ?? App::factory()->create()->id,
        ];
    }
}
