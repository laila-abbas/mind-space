<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ElasticsearchService;
use App\Models\Book;

class IndexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexing all books into Elasticsearch'; // TODO: implement bulk indexing

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = app(ElasticsearchService::class);

        Book::withCatalogData()
            ->chunk(100, function ($books) use ($service) {

                foreach ($books as $book) {
                    $service->indexBook($book);
                }

                $this->info("Indexed chunk of books...");
            });

        $this->info("All books indexed successfully!");
        }
}
