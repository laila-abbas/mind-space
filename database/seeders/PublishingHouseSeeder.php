<?php

namespace Database\Seeders;

use App\Models\PublishingHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublishingHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublishingHouse::factory()->count(3)->create();
    }
}
