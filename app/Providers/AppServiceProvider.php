<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to bind services into the container.
     * It is left empty here as no services are registered in this provider.
     */
    public function register(): void
    {
        // No application services are registered in this provider.
    }

    /**
     * Bootstrap any application services.
     *
     * This method is called after all services are registered.
     * It is used to perform actions such as binding view composers and policies.
     */
    public function boot(): void
    {
        // Share the count of unread notifications with all views if the user is authenticated.
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Get the count of unread notifications for the authenticated user.
                $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();

                // Share the unread notifications count with the view.
                $view->with('unreadNotificationsCount', $unreadNotificationsCount);
            }
        });
    }

    /**
     * Policy mappings for the application.
     *
     * The `$policies` property defines the relationship between models and their policies.
     */
    protected $policies = [
        Post::class => PostPolicy::class, // Bind the Post model to the PostPolicy class.
    ];
}
