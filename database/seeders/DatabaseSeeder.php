<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call role & permission seeder
        $this->call(RolePermissionSeeder::class);

        // Seed users with roles
        $this->call(UserSeeder::class);
    }
}

