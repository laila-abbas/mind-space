<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\ElasticsearchService;
use Illuminate\Pagination\LengthAwarePaginator;

class BookController extends Controller
{
    protected $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearch) {
        $this->elasticsearch = $elasticsearch;
    }

    public function index(Request $request)
    {
        $perPage = 12;
        $page = $request->input('page', 1);
        $from = ($page - 1) * $perPage;

        if ($request->filled('q') || $request->anyFilled(['language', 'format', 'price_max', 'published_from'])) {
            
            $results = $this->elasticsearch->search($request->query('q'), 
                array_merge($request->all(), ['from' => $from, 'size' => $perPage]));

            $hits = collect($results['hits']['hits']); // matched books array
            $total = $results['hits']['total']['value'] ?? 0; // number of returned results
            $ids = $hits->pluck('_id')->toArray(); // ids of matched books (paginated)

            if (empty($ids)) {
                $books = new LengthAwarePaginator(collect(), 0, $perPage, $page);
            } 
            else {
                $booksCollection = Book::withCatalogData()
                    ->whereIn('id', $ids)
                    ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")") // preserve es scoring order (w/o this, whereIn would return results in asc order, not relevance order)
                    ->get();

                // manual pagination needed for es results (total + items provided externally)
                $books = new LengthAwarePaginator($booksCollection, $total, $perPage, $page,
                    [
                        'path' => request()->url(), // preserve the url across the pages 
                        'query' => request()->query(), // preserve the search query across the pages
                    ]
                );
            }
        } 
        else {
            $books = Book::withCatalogData()->paginate($perPage); // no search query
        }

        return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        $publisherSlug = request('publisher');

        $book->load(Book::withCatalogData()->getEagerLoads());

        return view('books.show', ['book' => $book, 'publisherSlug' => $publisherSlug]);
    }
}

    

