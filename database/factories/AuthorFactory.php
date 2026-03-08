<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name(); 
        return [
            'pen_name' => $name,
            'biography' => fake()->paragraph(2),
            'website_url' => fake()->optional()->url(),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 9999),
        ];
    }
}
