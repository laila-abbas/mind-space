<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publishing_House>
 */
class PublishingHouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->company();

        return [
            'name' => $title,
            'description' => fake()->paragraph(2),
            'website_url' => fake()->url(),
            'email' => fake()->companyEmail(),
            'logo' => null,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 9999),
        ];
    }
}
