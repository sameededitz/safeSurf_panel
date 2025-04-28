<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 1, 10),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(1, 12),
            'duration_unit' => $this->faker->randomElement(['day', 'week', 'month', 'year']),
        ];
    }
}
