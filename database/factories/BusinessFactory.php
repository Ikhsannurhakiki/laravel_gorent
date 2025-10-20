<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = fake()->company();
        return [
            'owner_id' => User::factory(),
            'name' => $company,
            'address' => fake()->address(),
            'logo' => null,
            'phone' => fake()->phoneNumber(),
            'email' => Str::slug($company) . '@' . fake()->freeEmailDomain(),
        ];
    }
}
