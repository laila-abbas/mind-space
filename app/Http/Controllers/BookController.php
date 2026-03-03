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
                'editions' => function($q) {
                    $q->published()
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->with(['formats', 'publishingHouse']);
                },
            ])
            ->paginate(12);

        $books->getCollection()->transform(function ($book) {
            $book->ratingCount = $book->editions->sum('reviews_count');
            $avgRating = $book->editions->avg('reviews_avg_rating') ?? 0;
            $book->rating = number_format($avgRating, 1);

            return $book;
        });

        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $book->load([
            'authors',
            'categories',
            'editions' => function($q) {
                $q->published()
                ->with(['formats', 'publishingHouse'])
                ->withCount('reviews')         
                ->withAvg('reviews', 'rating')
                ->orderBy('published_at');
            },
        ]);

        return view('books.show', compact('book'));
    }
}
