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
            'format' => null,
            'ISBN' => fake()->optional()->isbn13(),
            'cover_image_path' => null,
            'price' => fake()->randomFloat(2, 0, 50),
            'stock' => null,
            'pages' => null,
            'duration_seconds' => null,
            'file_path' => null,
            'file_extension' => null,
            'size_MB' => null,
            'narrator' => null,
        ];
    }

     public function forFormat(string $format): static {
        return $this->state(function () use ($format) {

            return [
                'format' => $format,
                'pages' => $format === 'audiobook' ? null : fake()->numberBetween(100, 600),
                'duration_seconds' => $format === 'audiobook' ? fake()->numberBetween(3000, 20000) : null,
                'stock' => in_array($format, ['hardcover', 'paperback']) ? fake()->numberBetween(0, 100) : null,
                'file_path' => in_array($format, ['e-book', 'audiobook']) ? fake()->filePath() : null,
                'file_extension' => in_array($format, ['e-book', 'audiobook']) ? ($format === 'audiobook' ? 'mp3' : 'pdf') : null,
                'size_MB' => in_array($format, ['e-book', 'audiobook']) ? fake()->numberBetween(1, 200) : null,
                'narrator' => $format === 'audiobook' ? fake()->name() : null,
            ];
        });
    }   
}