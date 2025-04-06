<?php

namespace Database\Factories;

use App\Models\Data;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Data>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'type' => 'temperature',
			'data' => (string)(fake()->numberBetween(100,400) / 10),
			'timestamp' => fake()->dateTimeBetween(now()->subDays(1), now())
        ];
    }
}
