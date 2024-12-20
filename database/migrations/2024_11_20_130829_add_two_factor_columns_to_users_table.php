<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Adds columns for two-factor authentication (2FA) to the `users` table:
     * - `two_factor_secret`: Stores the secret key for generating 2FA tokens.
     * - `two_factor_recovery_codes`: Stores recovery codes for 2FA in case the user loses access.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add a column for storing the 2FA secret key (nullable).
            $table->text('two_factor_secret')
                ->after('password') // Position the column after the 'password' column.
                ->nullable();

            // Add a column for storing 2FA recovery codes (nullable).
            $table->text('two_factor_recovery_codes')
                ->after('two_factor_secret') // Position the column after 'two_factor_secret'.
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Removes the 2FA-related columns (`two_factor_secret` and `two_factor_recovery_codes`)
     * from the `users` table.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the two-factor authentication columns.
            $table->dropColumn([
                'two_factor_secret',
                'two_factor_recovery_codes',
            ]);
        });
    }
};
