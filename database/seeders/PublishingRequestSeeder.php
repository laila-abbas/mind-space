<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\PublishingHouse;
use App\Models\PublishingHouseUser;
use App\Models\PublishingRequest;

class PublishingRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::where('status', '!=', 'draft')->get();
        $publishingHouses = PublishingHouse::all();

        foreach($books as $book) {
            $house = $publishingHouses->random();

            $primaryAuthor = $book->authors()->wherePivot('role', 'primary')->first();

            $status = fake()->randomElement(['pending', 'under review', 'approved', 'rejected']);
            
            $reviewerId = null;
            if ($status !== 'pending') {
                $houseUsers = PublishingHouseUser::where('publishing_house_id', $house->id)->get();
                if ($houseUsers->count() > 0) {
                    $reviewerId = $houseUsers->random()->id;
                }
            }
            
            PublishingRequest::create([
                'book_id' => $book->id,
                'publishing_house_id' => $house->id,
                'submitted_by' => $primaryAuthor->user_id,
                'status' => $status,
                'reviewer_id' => $reviewerId,
                'review_notes' => $status !== 'pending' ? fake()->paragraph() : null,
                'submitted_at' => now(),
                'reviewed_at' => $status !== 'pending' ? now() : null,
            ]);
        }
    }
}
