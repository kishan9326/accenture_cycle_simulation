<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('admin@!@#')
        ]);
    }
}
