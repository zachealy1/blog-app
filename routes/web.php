<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route for the homepage
Route::get('/', function () {
    return view('welcome');
});

// Route for the dashboard, showing the latest posts.
// This route is protected by 'auth' and 'verified' middleware.
Route::get('/dashboard', function () {
    $posts = Post::with('user')->latest()->get(); // Eager load users for posts.
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post management routes
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::resource('posts', PostController::class); // Resource route for posts CRUD.

    // Comment management route
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Notification route
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // User profile view route
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

// Admin-only routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin user management routes
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
});

// Include the authentication routes.
require __DIR__ . '/auth.php';
