<?php

namespace App\Observers;

use App\Models\Edition;

class EditionObserver
{
    public function deleted(Edition $edition): void
    {
        if ($edition->isForceDeleting()) {
            return;
        }

        $edition->formats->each->delete();
    }

    public function restored(Edition $edition): void
    {
        $edition->formats()->withTrashed()->get()->each->restore();
    }

    public function forceDeleted(Edition $edition): void
    {
        $edition->formats()->withTrashed()->get()->each->forceDelete();
    }
}
