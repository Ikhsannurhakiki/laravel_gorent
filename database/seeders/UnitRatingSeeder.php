<?php

namespace Database\Seeders;

use App\Models\Unit;
use Database\Factories\UnitRatingFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitRating;
use App\Models\User;


class UnitRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $unit = Unit::inRandomOrder()->first() ?? Unit::factory()->create();

        UnitRating::create([
            'unit_id' => $unit->id,
            'user_id' => $user->id,
            'stars' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(),
        ]);
    }
}
