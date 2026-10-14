<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::updateOrCreate(
            ['email' => 'admin@travora.com'],
            [
                'name' => 'Travora Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'country' => 'Pakistan',
            ]
        );

        // Create a demo user
        User::updateOrCreate(
            ['email' => 'user@travora.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'country' => 'Pakistan',
            ]
        );
    }
}