<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;
use App\Models\Book;

class ElasticsearchService
{
    protected $client;

    public function __construct() {
        $this->client = ClientBuilder::create()
            ->setHosts([config('services.elasticsearch.host')])
            ->build();
    }

    public function testConnection() {
        $response = $this->client->ping();

        return $response ? 'Connection successful' : 'Connection failed';
    }

    public function client() {
        return $this->client;
    }

    public function indexBook(Book $book)
    {
        $variants = $book->published_editions->flatMap(function ($edition) {
            return $edition->formats->map(function ($format) use ($edition) {
                return [
                    'edition_title' => $edition->edition_title,
                    'language' => $edition->language,
                    'published_at' => $edition->published_at,
                    'format' => $format->format,
                    'price' => (float) $format->price,
                ];
            });
        })->values()->toArray();

        $document = [
            'title' => $book->title,
            'description' => $book->description,
            'authors' => $book->authors->pluck('display_name')->toArray(),
            'edition_titles' => $book->published_editions->pluck('edition_title')->toArray(),

            'categories_slugs' => $book->categories->pluck('slug')->toArray(),
            'publishing_houses_slugs' => $book->published_editions
                ->map(fn($e) => $e->publishingHouse?->name)
                ->filter()->unique()->values()->toArray(),
            'author_slugs' => $book->authors->pluck('slug')->toArray(),

            'variants' => $variants,
        ];

        return $this->client->index([
            'index' => 'books',
            'id' => $book->id,
            'body' => $document
        ]);
    }

    public function deleteBook($id)
    {
        return $this->client->delete([
            'index' => 'books',
            'id' => $id
        ]);
    }

    public function search($query, $filters = [])
    {
        $query = trim((string) $query);

        $must = [];
        $filter = [];

        if ($query !== '') {
            $must[] = [
                'multi_match' => [
                    'query' => $query,
                    'fields' => [
                        'title^3',
                        'description',
                        'authors^2',
                        'edition_titles'
                    ],
                    'fuzziness' => 'AUTO'
                ]
            ];
        } 
        else {
            $must[] = ['match_all' => new \stdClass()];
        }

        if (!empty($filters['category'])) {
            $filter[] = ['term' => ['categories_slugs' => $filters['category']]];
        }

        if (!empty($filters['author'])) {
            $filter[] = ['term' => ['author_slugs' => $filters['author']]];
        }

        if (!empty($filters['publisher'])) {
            $filter[] = ['term' => ['publishing_houses_slugs' => $filters['publisher']]];
        }

        $variantConditions = [];

        if (!empty($filters['language'])) {
            $variantConditions[] = [
                'term' => ['variants.language' => $filters['language']]
            ];
        }

        if (!empty($filters['format'])) {
            $variantConditions[] = [
                'term' => ['variants.format' => $filters['format']]
            ];
        }

        if (isset($filters['price_max']) && $filters['price_max'] !== '') {
            $variantConditions[] = [
                'range' => [
                    'variants.price' => [
                        'lte' => (float) $filters['price_max']
                    ]
                ]
            ];
        }

        if (!empty($filters['published_from'])) {
            $year = (int) $filters['published_from'];
            $variantConditions[] = [
                'range' => [
                    'variants.published_at' => [
                        'gte' => $year . '-01-01',
                        'lte' => $year . '-12-31'
                    ]
                ]
            ];
        }

        if (!empty($variantConditions)) {
            $filter[] = [
                'nested' => [
                    'path' => 'variants',
                    'query' => ['bool' => ['must' => $variantConditions]]
                ]
            ];
        }

        $params = [
            'index' => 'books',
            'body' => [
                'from' => $filters['from'] ?? 0,
                'size' => $filters['size'] ?? 10,

                'query' => [
                    'bool' => [
                        'must' => $must,
                        'filter' => $filter,
                    ]
                ]
            ]
        ];

        return $this->client->search($params)->asArray();
    }
}