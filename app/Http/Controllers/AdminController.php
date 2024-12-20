<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * Retrieves a list of all users from the database and displays the admin dashboard.
     *
     * @return View|Factory|Application The rendered view for the admin dashboard.
     */
    public function index(): View|Factory|Application
    {
        // Fetch all users from the database.
        $users = User::all();

        // Render the 'admin.dashboard' view, passing the list of users to the view.
        return view('admin.dashboard', compact('users'));
    }
}
