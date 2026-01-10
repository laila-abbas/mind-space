<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Edition;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(2),
            'ISBN' => fake()->optional()->isbn13(),
            'language' => fake()->randomElement(['English', 'French', 'Arabic']),
            'cover_image_path' => null,
            'status' => fake()->randomElement(['draft', 'submitted', 'published', 'rejected']),
        ];
    }

    public function published() {
        return $this->state(fn () => [
            'status' => 'published'
        ]);
    }

    public function withEditions($count = 1) {
        return $this->has(
            Edition::factory()->count($count)
        );
    }
}
