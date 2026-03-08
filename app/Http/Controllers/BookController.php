<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::withCatalogData()->paginate(12);

        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $book->load(Book::withCatalogData()->getEagerLoads());

        return view('books.show', compact('book'));
    }
}
