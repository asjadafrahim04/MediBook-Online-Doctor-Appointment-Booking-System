<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@medibook.com', // Change to your email
            'password' => Hash::make('admin123'), // Change password
            'role' => 'admin',
            'phone' => null,
        ]);
    }
}