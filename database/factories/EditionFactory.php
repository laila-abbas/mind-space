<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Edition>
 */
class EditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ // book_id
            'format' => fake()->randomElement(['hardcover', 'paperback', 'e-book', 'audiobook']),
            'price' => fake()->randomFloat(2, 5, 50),
            'pages' => fake()->numberBetween(100, 600),
            'publication_date' => fake()->date(),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
