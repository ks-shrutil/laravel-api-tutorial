<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * Undocumented function
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['A', 'C', 'H', 'X']),
        ];
    }
}
