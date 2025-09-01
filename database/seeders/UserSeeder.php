<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\UserStatus;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create one admin user
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        // Create 5 publisher users
        User::factory()->count(5)->create([
            'role' => UserRole::PUBLISHER,
        ]);

        // Create 20 attendee users
        User::factory()->count(20)->create();
    }
}