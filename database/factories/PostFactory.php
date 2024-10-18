<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
        return [
            // 'item_id' => rand(1,10),
            // 'title_uz' => fake()->name(),
            // 'title_qr' => fake()->name(),
            // 'title_ru' => fake()->name(),
            // 'body_uz' => fake()->text(),
            // 'body_qr' => fake()->text(),
            // 'body_ru' => fake()->text(),
            // 'slug' => fake()->slug(),
            // 'photo' => Str::random(10),
        ];
    }
}
