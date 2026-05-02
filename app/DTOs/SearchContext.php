<?php

namespace App\DTOs;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class SearchContext
{
    public function __construct(
        public ?string $query,
        public array $userFilters,
        public array $contextFilters,
        public int $page,
        public int $perPage,
        public Builder|Relation $baseQuery,
    ) {}

    public function hasSearch() {
        return $this->query || array_filter($this->userFilters);
    }

    public function allFilters() {
        return array_merge($this->userFilters, $this->contextFilters);
    }
}