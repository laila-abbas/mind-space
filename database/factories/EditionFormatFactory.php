<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EditionFormat>
 */
class EditionFormatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'format' => fake()->randomElement(['hardcover', 'paperback', 'e-book', 'audiobook']),
            'ISBN' => fake()->optional()->isbn13(),
            'cover_image_path' => null,
            'price' => fake()->randomFloat(2, 5, 50),
            'pages' => fake()->numberBetween(100, 600),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
