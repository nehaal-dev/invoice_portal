<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'nehalkhan4639@gmail.com.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('4639'),
            ]
        );
    }
}