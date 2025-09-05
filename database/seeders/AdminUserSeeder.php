<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin2',
            'email' => 'admin2@email.com',
            'password' => Hash::make('adminadmin'),
            'role' => UserRole::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
