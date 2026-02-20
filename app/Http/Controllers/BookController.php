<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::hasPublishedEdition()
                ->with(['authors', 'categories', 'editions' => fn($q) => $q->published()])
                ->paginate(12);
        
        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $book->load(['authors', 'categories', 'editions' => fn($q) => $q->published()]);

        return view('books.show', compact('book'));
    }
}
