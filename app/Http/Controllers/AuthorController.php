<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::with('user')
            ->whereHas('books', fn($q) => $q->hasPublishedEdition())
            ->withCount(['books as published_books_count' => fn($q) => $q->hasPublishedEdition()])
            ->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show(Author $author) {
        $author->load([
            'user',
            'books' => fn($q) => $q->hasPublishedEdition()->with(['editions' => fn($e) => $e->published()])
        ]);

        return view('authors.show', compact('author'));
    }
}
