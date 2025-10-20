<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'name' => fake()->car()->,
            'type' => fake()->randomElement(['car', 'house', 'condo']),
            'description' => fake()->paragraphs(5, true),
            'price_per_day' => fake()->numberBetween(50, 500),
            'is_available' => fake()->boolean(80),
            'thumbnail' => null,
        ];
    }
}
