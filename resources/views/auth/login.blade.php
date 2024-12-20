<x-guest-layout>
    <!-- Session Status -->
    <!-- Displays a status message if there is any (e.g., after password reset email sent) -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- CSRF protection token to secure the form -->

        <!-- Email Address -->
        <div>
            <!-- Label for the email input -->
            <x-input-label for="email" :value="__('Email')"/>

            <!-- Email input field -->
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email"
                          :value="old('email')" required autofocus autocomplete="username"/>

            <!-- Display validation error messages for the email field -->
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <!-- Label for the password input -->
            <x-input-label for="password" :value="__('Password')"/>

            <!-- Password input field -->
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password"
                          required autocomplete="current-password"/>

            <!-- Display validation error messages for the password field -->
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <!-- Checkbox for "Remember me" functionality -->
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Additional Actions -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <!-- Link to the "Forgot Password" page -->
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Submit button for logging in -->
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
