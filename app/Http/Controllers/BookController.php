<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::hasPublishedEdition()
                ->with([
                    'authors',
                    'categories',
                    'editions' => fn($q) => $q->published()->with(['formats', 'publishingHouse'])
                ])->paginate(12);
        
        // default for now
        $books->getCollection()->transform(function ($book) {
            $book->rating = 3.5;         
            $book->ratingCount = 12;     
            return $book;
        });


        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $book->load([
            'authors',
            'categories',
            'editions' => fn($q) => $q->published()->with(['formats', 'publishingHouse'])->orderBy('published_at'),
        ]);

        // default for now
        $book->rating = 4.5;
        $book->ratingCount = 8;

        return view('books.show', compact('book'));
    }
}
