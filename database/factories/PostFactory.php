<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(rand(6,8));
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'body' => fake()->paragraphs(5, true),
        ];
    }
}
