<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = View::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // Generate or associate a post
            'user_id' => User::factory(), // Generate or associate a user
        ];
    }
}
