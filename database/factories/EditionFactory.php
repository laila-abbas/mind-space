<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PublishingHouse;
use App\Models\EditionReview;
use App\Models\User;

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
        return [ 
            'publishing_house_id' => PublishingHouse::factory(),
            'edition_title' => fake()->optional()->words(2, true),
            // 'edition_number' => fake()->numberBetween(1, 5),
            'edition_description' => fake()->optional()->paragraph(), 
            'language' => fake()->randomElement(['English', 'French', 'Arabic']),
            'published_at' => fake()->optional(0.7)->dateTime(), 
        ];
    }

    public function withReviews() {
        return $this->afterCreating(function ($edition) {

            $reviewCount = fake()->numberBetween(0, 20);

            if ($reviewCount === 0) return;

            $users = User::inRandomOrder()->take($reviewCount)->get();

            foreach ($users as $user) {
                EditionReview::factory()->create([
                    'edition_id' => $edition->id,
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
