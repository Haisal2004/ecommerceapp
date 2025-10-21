<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // check if exists
            [
                'name' => 'Admin User',
                'phone' => '9999999999',
                'password' => Hash::make('admin123'),
                'role_id' => 1
            ]
        );

        // Manager
        User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'phone' => '8888888888',
                'password' => Hash::make('manager123'),
                'role_id' => 2
            ]
        );

        // Customer
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer User',
                'phone' => '7777777777',
                'password' => Hash::make('customer123'),
                'role_id' => 3
            ]
        );
    }
}

