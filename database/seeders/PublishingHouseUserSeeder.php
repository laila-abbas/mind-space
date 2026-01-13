<?php

namespace Database\Seeders;

use App\Models\PublishingHouse;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublishingHouseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishingHouses = PublishingHouse::all();
        $users = User::doesntHave('author')->get();

        foreach($publishingHouses as $house) {
            $assignedUsers = $users->random(fake()->numberBetween(1, 5));
            foreach($assignedUsers as $user) {
                // All users are already readers from User seeder
                $user->assignRole('Publisher');
                $house->users()->attach($user->id, [
                    'position' => fake()->randomElement(['editor', 'reviewer', 'manager'])
                ]);
            }
        }
    }
}
