<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $authors = Author::all();

        foreach($books as $book) {
            $primaryAuthor = $authors->random();
            $book->authors()->attach($primaryAuthor->id, ['role' => 'primary']);

            $extraAuthors = $authors->except($primaryAuthor->id)
                                    ->random(fake()->numberBetween(0, 2));
            
            foreach($extraAuthors as $author) {
                $book->authors()->attach($author->id, [
                    'role' => fake()->randomElement(['co-author', 'editor'])
                ]);
            }
        }
    }
}
