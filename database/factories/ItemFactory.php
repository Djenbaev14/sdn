<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_uz' => fake()->name(),
            'name_ru' => fake()->name(),
            'name_qr' => fake()->name(),
            'slug' => fake()->slug(),
            'is_news' => fake()->boolean()
        ];
    }
    
    
}
