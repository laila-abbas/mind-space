<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Edition;
use App\Models\EditionFormat;
use Illuminate\Support\Str;

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
        $title = fake()->words(2, true);
        return [
            'title' => $title,
            'description' => fake()->paragraph(2),
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 9999),
        ];
    }

    public function withEditions() {
        return $this->afterCreating(function ($book) {

            $editionCount = fake()->numberBetween(1, 5);

            for ($i = 1; $i <= $editionCount; $i++) { 
                $edition = Edition::factory()->create(['book_id' => $book->id, 'edition_number' => $i]);

                $formats = collect(['hardcover', 'paperback', 'e-book', 'audiobook'])
                            ->shuffle()
                            ->take(fake()->numberBetween(1, 4));

                $edition->formats()->saveMany(
                    $formats->map(fn ($format) => EditionFormat::factory()->make(['format' => $format]))
                );

            }
        });
    }
}
