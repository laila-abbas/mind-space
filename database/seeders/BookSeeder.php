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
        // books without editions (for authors)
        Book::factory()
            ->count(20)
            ->create();

        $booksWithEditions = Book::factory()
            ->count(50)
            ->withEditions()
            ->create();

        $booksWithPublishedEditions = $booksWithEditions->filter(function ($book) {
            return $book->editions->whereNotNull('published_at')->isNotEmpty();
        });

        $categories = Category::whereNotNull('parent_id')->get();

        foreach ($booksWithPublishedEditions as $book) {
            $book->categories()->attach(
                $categories->random(fake()->numberBetween(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
