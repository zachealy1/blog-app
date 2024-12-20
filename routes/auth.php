<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| This file defines all authentication-related routes for the application.
| It includes routes for registration, login, password management, email
| verification, and session handling.
|
*/

Route::middleware('guest')->group(function () {
    // Registration Routes
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register'); // Display registration form.
    Route::post('register', [RegisteredUserController::class, 'store']); // Handle new user registration.

    // Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Display login form.
    Route::post('login', [AuthenticatedSessionController::class, 'store']); // Handle login attempt.

    // Password Reset Routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request'); // Display forgot password form.
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email'); // Send password reset email.
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset'); // Display reset password form.
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store'); // Handle password reset.
});

Route::middleware('auth')->group(function () {
    // Email Verification Routes
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice'); // Display email verification prompt.
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify'); // Verify user's email using signed URL.

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send'); // Resend email verification notification.

    // Confirm Password Route
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm'); // Display password confirmation form.
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Handle password confirmation.

    // Password Update Route
    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); // Update user's password.

    // Logout Route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // Handle user logout.
});
