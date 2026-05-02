<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\CatalogSearchService;
use App\DTOs\SearchContext;

class BookController extends Controller
{
    public function index(Request $request, CatalogSearchService $search) {
        $books = $search->resolve(new SearchContext(
            query: $request->query('q'),
            userFilters: $request->only(['language', 'format', 'price_max', 'published_from']),
            contextFilters: [], 
            page: $request->input('page', 1),
            perPage: 12,
            baseQuery: Book::withCatalogData(),
        ));

        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $publisherSlug = request('publisher');

        $book->load(Book::withCatalogData()->getEagerLoads());

        return view('books.show', ['book' => $book, 'publisherSlug' => $publisherSlug]);
    }
}

    

