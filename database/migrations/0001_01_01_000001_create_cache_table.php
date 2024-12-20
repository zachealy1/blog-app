<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the tables for caching data and locking mechanisms in the database.
     */
    public function up(): void
    {
        // Create 'cache' table for storing cached data
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Primary key: the unique cache key
            $table->mediumText('value'); // MediumText field to store the cached data (the value)
            $table->integer('expiration'); // Expiration time of the cached item (in UNIX timestamp format)
        });

        // Create 'cache_locks' table for managing cache locks
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Primary key: the unique key for the lock
            $table->string('owner'); // The owner of the lock (usually some identifier for the lock owner)
            $table->integer('expiration'); // Expiration time for the lock (in UNIX timestamp format)
        });
    }

    /**
     * Reverse the migrations.
     * This method will drop the tables when rolling back the migration.
     */
    public function down(): void
    {
        // Drop the 'cache' table
        Schema::dropIfExists('cache');

        // Drop the 'cache_locks' table
        Schema::dropIfExists('cache_locks');
    }
};
