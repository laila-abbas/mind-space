<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublishingHouse;
use App\Models\Book;
use App\Services\CatalogSearchService;
use App\DTOs\SearchContext;

class PublishingHouseController extends Controller
{
    public function index() {
        $publishingHouses = PublishingHouse::withPublishedBooksCount()->paginate(10);

        return view('publishing-houses.index', compact('publishingHouses'));
    }

    public function show(Request $request, PublishingHouse $publishingHouse, CatalogSearchService $search) {
        $books = $search->resolve(new SearchContext(
            query: $request->query('q'),
            userFilters: $request->only(['language', 'format', 'price_max', 'published_from']),
            contextFilters: ['publisher' => $publishingHouse->slug],
            page: $request->input('page', 1),
            perPage: 12,
            baseQuery: Book::publishedByHouse($publishingHouse->id)->withCatalogData(),
        ));

        return view('publishing-houses.show', compact('publishingHouse', 'books'));
    }
}
