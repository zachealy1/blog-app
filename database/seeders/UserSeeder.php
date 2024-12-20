<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the user seeds.
     * This method will generate fake user data and create a specific test admin user.
     */
    public function run(): void
    {
        // Use the User factory to create 10 random users
        User::factory(10)->create();

        // Create a specific test user with predefined details
        User::factory()->create([
            'first_name' => 'Test',            // First name of the test user
            'last_name' => 'User',             // Last name of the test user
            'email' => 'test@example.com',     // Email of the test user
            'password' => bcrypt('password'),  // Default password (hashed)
            'admin' => true,                   // Set this user as an admin
        ]);
    }
}
