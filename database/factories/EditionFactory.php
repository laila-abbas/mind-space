<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PublishingHouse;

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
            'publishing_house_id' => PublishingHouse::factory(),
            'format' => fake()->randomElement(['hardcover', 'paperback', 'e-book', 'audiobook']),
            'ISBN' => fake()->optional()->isbn13(),
            'language' => fake()->randomElement(['English', 'French', 'Arabic']),
            'cover_image_path' => null,
            'price' => fake()->randomFloat(2, 5, 50),
            'pages' => fake()->numberBetween(100, 600),
            'published_at' => fake()->optional(0.7)->dateTime(),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
