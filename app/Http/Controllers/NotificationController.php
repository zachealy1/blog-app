<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class NotificationController extends Controller
{
    /**
     * Display the list of notifications for the authenticated user.
     *
     * Marks all unread notifications as read and retrieves all notifications
     * to be displayed on the notifications index page.
     *
     * @return View|Factory|Application The view displaying the user's notifications.
     */
    public function index(): View|Factory|Application
    {
        // Mark all unread notifications as read for the authenticated user.
        auth()->user()->unreadNotifications->markAsRead();

        // Retrieve all notifications for the authenticated user.
        $notifications = auth()->user()->notifications;

        // Render the 'notifications.index' view, passing the notifications data to the view.
        return view('notifications.index', compact('notifications'));
    }
}
