<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the tables and their columns that will be created in the database.
     */
    public function up(): void
    {
        // Create 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key: auto-incrementing ID
            $table->string('first_name'); // First name of the user
            $table->string('last_name'); // Last name of the user
            $table->string('email')->unique(); // Email address, must be unique
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp, nullable if not verified
            $table->string('password'); // Password hash for authentication
            $table->boolean('admin')->default(false); // Boolean to identify if the user is an admin, defaults to false
            $table->rememberToken(); // Token for "remember me" sessions
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });

        // Create 'password_reset_tokens' table for password resets
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key, the email address associated with the password reset
            $table->string('token'); // Token for resetting the password
            $table->timestamp('created_at')->nullable(); // Timestamp for when the token was created, nullable if not created
        });

        // Create 'sessions' table for storing user sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID, primary key
            $table->foreignId('user_id')->nullable()->index(); // Foreign key linking to 'users' table, nullable if not linked to a user
            $table->string('ip_address', 45)->nullable(); // IP address of the user (up to 45 characters for IPv6 compatibility)
            $table->text('user_agent')->nullable(); // User agent string for the user's device/browser, nullable
            $table->longText('payload'); // The session data (stored as a long text)
            $table->integer('last_activity')->index(); // Timestamp of the user's last activity, indexed for faster queries
        });
    }

    /**
     * Reverse the migrations.
     * This method is used to drop the tables when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'users' table
        Schema::dropIfExists('users');

        // Drop the 'password_reset_tokens' table
        Schema::dropIfExists('password_reset_tokens');

        // Drop the 'sessions' table
        Schema::dropIfExists('sessions');
    }
};
