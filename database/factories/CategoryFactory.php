<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 9999),
            'parent_id' => null,
        ];
    }

    public function child()
    {
        return $this->state(fn () => [
            'parent_id' => Category::whereNull('parent_id')
                                    ->inRandomOrder()
                                    ->first()
                                    ->id 
                            ?? Category::factory(), 
        ]);
    }
}
