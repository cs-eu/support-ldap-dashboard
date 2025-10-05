<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeamerAccess>
 */
class BeamerAccessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name()." ".fake()->firstName(),
            'email' => fake()->email(),
            'accessd_at' => fake()->dateTime(),
        ];
    }
}
