<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class PurgeDeletedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:purge-deleted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete users who have been soft deleted for more than 14 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subDay(14);

        $users = User::onlyTrashed()->where('deleted_at', '<=', $date)->get();

        $count = $users->count();

        foreach ($users as $user) {
            $user->forceDelete();
        }

        $this->info("Deleted $count users permanently.");
    }
}
