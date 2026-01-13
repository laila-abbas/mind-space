<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'email_verified_at' => now()
            ]
        );

        $user->assignRole('Admin');
    }
}
