<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // To account for CI, we use `findOrCreate` everywhere to make sure
        // that when forcing the seeding procedure we don't cause any errors by
        // attempting to create things that already exist.
        Role::findOrCreate('admin');
    }
}
