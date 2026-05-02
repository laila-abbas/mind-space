<?php 

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ElasticsearchQueryService
{
    public function __construct(protected ElasticsearchService $es) {} // constructor property promotion 

    public function searchAndPaginate(
        ?string $query, array $filters, int $perPage, int $page, Builder|Relation $baseQuery) 
    {
        $from = ($page - 1) * $perPage;

        $results = $this->es->search($query, array_merge($filters, ['from' => $from, 'size' => $perPage]));

        $hits = collect($results['hits']['hits'] ?? []); // matched books array
        $total = $results['hits']['total']['value'] ?? 0; // number of returned results
        $ids = $hits->pluck('_id')->map(fn($id) => (int) $id)->values(); // ids of matched books

        if ($ids->isEmpty()) {
            return new LengthAwarePaginator(collect(), 0, $perPage, $page);
        }

        $idPositions = $ids->flip();

        $models = $baseQuery->whereIn('books.id', $ids)->get()
            // preserve es scoring order (w/o this, whereIn would return results in asc order, not relevance order)
            ->sortBy(fn($model) => $idPositions[$model->id])
            ->values();

        return new LengthAwarePaginator($models, $total, $perPage, $page,
            [
                'path' => request()->url(), // preserve the url across the pages
                'query' => request()->query() // preserve the search query across the pages
            ]
        );
    }
}