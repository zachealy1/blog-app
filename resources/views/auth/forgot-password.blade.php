<x-guest-layout>
    <!-- Informational message -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status Message -->
    <!-- Displays a status message if the password reset email was sent successfully -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Password Reset Request Form -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf <!-- CSRF protection token -->

        <!-- Email Address Input -->
        <div>
            <!-- Label for the email input -->
            <x-input-label for="email" :value="__('Email')"/>

            <!-- Email input field -->
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email"
                          :value="old('email')" required autofocus/>

            <!-- Error message for invalid email -->
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
