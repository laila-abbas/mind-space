<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublishingHouse;
use App\Models\Book;

class PublishingHouseController extends Controller
{
    public function index() {
        $publishingHouses = PublishingHouse::withPublishedBooksCount()->paginate(10);

        return view('publishing-houses.index', compact('publishingHouses'));
    }

    public function show(PublishingHouse $publishingHouse) {
        $books = Book::publishedByHouse($publishingHouse->id)->withCatalogData()->paginate(12);

        return view('publishing-houses.show', compact('publishingHouse', 'books'));
    }
}
