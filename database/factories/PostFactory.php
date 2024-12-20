<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     * This method provides default values for each attribute when creating a Post instance.
     *
     * @return array<string, mixed> An array of default attribute values.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associate each post with a new or existing user.
            'title' => $this->faker->sentence, // Generate a random sentence as the title.
            'content' => $this->faker->paragraph, // Generate a random paragraph for the content.
        ];
    }
}
