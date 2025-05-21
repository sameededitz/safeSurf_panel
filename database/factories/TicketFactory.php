<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => '2',
            'subject' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['open', 'closed', 'pending']),
            'department' => $this->faker->randomElement(['support', 'billing', 'sales']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }
}
