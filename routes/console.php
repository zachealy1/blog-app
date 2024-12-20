<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Define a custom Artisan command named 'inspire'.
Artisan::command('inspire', function () {
    // Output an inspiring quote from the Inspiring facade.
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote') // Add a purpose description for the command.
    ->hourly(); // Schedule the command to run hourly (if this scheduling is applied to a console kernel or task).
