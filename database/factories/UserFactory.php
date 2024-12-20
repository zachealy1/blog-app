<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class; // Specifies the User model for this factory.

    /**
     * The current password being used by the factory.
     *
     * @var ?string
     */
    protected static ?string $password = null; // A shared hashed password to avoid re-hashing each time.

    /**
     * Define the model's default state.
     * This method generates default values for each attribute of the User model.
     *
     * @return array<string, mixed> Default values for a new User instance.
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(), // Random first name for the user.
            'last_name' => fake()->lastName(), // Random last name for the user.
            'email' => fake()->unique()->safeEmail(), // Unique, safe email address for the user.
            'email_verified_at' => now(), // Verification timestamp set to the current date and time.
            'password' => static::$password ??= Hash::make('password'), // Default hashed password.
            'admin' => fake()->boolean(20), // 20% chance to set the user as an admin.
            'remember_token' => Str::random(10), // Random string for the "remember me" session token.
        ];
    }
}
