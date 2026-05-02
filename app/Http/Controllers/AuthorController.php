<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Services\CatalogSearchService;
use App\DTOs\SearchContext;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::with('user')
            ->whereHas('books', fn($q) => $q->hasPublishedEdition())
            ->withCount(['books as published_books_count' => fn($q) => $q->hasPublishedEdition()])
            ->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show(Request $request, Author $author, CatalogSearchService $search) {
        $author->load('user');

        $books = $search->resolve(new SearchContext(
            query: $request->query('q'),
            userFilters: $request->only(['language', 'format', 'price_max', 'published_from']), 
            contextFilters: ['author' => $author->slug ],
            page: $request->input('page', 1),
            perPage: 12,
            baseQuery: $author->books()->withCatalogData(),
        ));

        return view('authors.show', compact('author', 'books'));
    }
}
