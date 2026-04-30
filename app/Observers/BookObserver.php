<?php

namespace App\Observers;

use App\Models\Book;
use App\Services\ElasticsearchService;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        if ($book->isForceDeleting()) {
            return;
        }

        $book->editions->each->delete();
        app(ElasticsearchService::class)->deleteBook($book->id);
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        $book->editions()->withTrashed()->get()->each->restore();
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        $book->editions()->withTrashed()->get()->each->forceDelete();
    }

    public function saved(Book $book)
    {
        app(ElasticsearchService::class)->indexBook($book); // TODO: create jobs for updating es db
    }
    
}
