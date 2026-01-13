<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // non-published books (no editions)
        Book::factory()
            ->count(20)
            ->create();

        // published books (with editions)
        $publishedBooks = Book::factory()
            ->published()
            ->count(30)
            ->withEditions(fake()->numberBetween(2, 4))
            ->create();

        $categories = Category::whereNotNull('parent_id')->get();

        foreach($publishedBooks as $book) {
            $book->categories()->attach(
                $categories->random(fake()->numberBetween(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
