<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * This method is the main entry point for running all the individual seeders.
     */
    public function run(): void
    {
        // Call individual seeders to populate the database
        $this->call([
            UserSeeder::class,    // Seeder to create users
            PostSeeder::class,    // Seeder to create posts
            CommentSeeder::class, // Seeder to create comments
            ViewSeeder::class,    // Seeder to create views
            LikeSeeder::class,    // Seeder to create likes
            NotificationSeeder::class, // Seeder to create notifications
        ]);
    }
}
