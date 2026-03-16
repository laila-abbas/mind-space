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
        $publisherSlug = request('publisher');

        $book->load(Book::withCatalogData()->getEagerLoads());

        return view('books.show', ['book' => $book, 'publisherSlug' => $publisherSlug]);
    }
}
