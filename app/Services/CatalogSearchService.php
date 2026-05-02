<?php

namespace App\Services;

use App\DTOs\SearchContext;

class CatalogSearchService
{
    public function __construct(private ElasticsearchQueryService $search) {}

    public function resolve(SearchContext $ctx)
    {
        if ($ctx->hasSearch()) {
            return $this->search->searchAndPaginate(
                $ctx->query,
                $ctx->allFilters(),
                $ctx->perPage,
                $ctx->page,
                $ctx->baseQuery
            );
        }

        return $ctx->baseQuery->paginate($ctx->perPage);
    }
}