<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorised to make this request.
     *
     * @return bool Always returns true since login requests do not require specific permissions.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string> The validation rules for the email and password fields.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'], // Email must be provided and in a valid format.
            'password' => ['required', 'string'],       // Password is required.
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * Validates the provided credentials against the authentication system.
     * Applies rate limiting and throws a validation exception if authentication fails.
     *
     * @throws \Illuminate\Validation\ValidationException If authentication fails or rate limit is exceeded.
     */
    public function authenticate(): void
    {
        // Ensure the request is not rate-limited before attempting authentication.
        $this->ensureIsNotRateLimited();

        // Attempt to authenticate using the provided credentials and remember option.
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Increment the rate limiter counter if authentication fails.
            RateLimiter::hit($this->throttleKey());

            // Throw a validation exception with an error message.
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'), // Use the translatable authentication failure message.
            ]);
        }

        // Clear the rate limiter counter on successful authentication.
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * Checks the rate limiter for too many login attempts and throws a validation exception if exceeded.
     *
     * @throws \Illuminate\Validation\ValidationException If the request exceeds the allowed attempts.
     */
    public function ensureIsNotRateLimited(): void
    {
        // Allow up to 5 attempts before throttling.
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // Fire the Lockout event to allow listeners to handle the lockout scenario.
        event(new Lockout($this));

        // Calculate the number of seconds until the user can try again.
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Throw a validation exception with a throttle error message.
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60), // Convert seconds to minutes.
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * Combines the user's email and IP address to create a unique throttle key.
     *
     * @return string The unique throttle key for rate limiting.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('email')) . '|' . $this->ip()
        );
    }
}
