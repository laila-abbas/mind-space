<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ElasticsearchService;

class CreateBookIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:create-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or recreate the Elasticsearch index for books';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = app(ElasticsearchService::class)->client();

        $params = [
            'index' => 'books', 
            'body' => [ // standard analyzer
                'mappings' => [
                    'properties' => [

                        // what user can search for
                        'title' => ['type' => 'text'],
                        'description' => ['type' => 'text'],
                        'authors' => ['type' => 'text'],
                        'edition_titles' => ['type' => 'text'],

                        // filters
                        // not shown in the filter panel (will be sent depending on where the user is)
                        'categories_slugs' => ['type' => 'keyword'],
                        'publishing_houses_slugs' => ['type' => 'keyword'],
                        'author_slugs' => ['type' => 'keyword'],
                        
                        // shown in the filter panel
                        'variants' => [
                            'type' => 'nested',
                            'properties' => [
                                'edition_title' => ['type' => 'text'],
                                'language' => ['type' => 'keyword'],
                                'published_at' => ['type' => 'date'],

                                'format' => ['type' => 'keyword'],
                                'price' => ['type' => 'float'],
                            ]
                        ],
                    ]
                ]
            ]
        ];

        try {
            if ($client->indices()->exists(['index' => 'books'])->asBool()) {
                $client->indices()->delete(['index' => 'books']);
                $this->info('Old books index deleted.');
            }

            $client->indices()->create($params);
            $this->info('Books index created successfully!');
        } catch (\Exception $e) {
            $this->error('Error creating index: ' . $e->getMessage());
        }
    }
}