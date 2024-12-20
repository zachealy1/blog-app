<x-guest-layout>
    <!-- Password Reset Form -->
    <form method="POST" action="{{ route('password.store') }}">
        @csrf <!-- CSRF token for security -->

        <!-- Password Reset Token -->
        <!-- This hidden input stores the reset token from the URL for submission -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <!-- Label for the email input -->
            <x-input-label for="email" :value="__('Email')"/>

            <!-- Input field for email address -->
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email"
                          :value="old('email', $request->email)"
                          required autofocus autocomplete="username"/>

            <!-- Display validation error messages for the email field -->
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <!-- Label for the password input -->
            <x-input-label for="password" :value="__('Password')"/>

            <!-- Input field for the new password -->
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password"
                          required autocomplete="new-password"/>

            <!-- Display validation error messages for the password field -->
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <!-- Label for the confirm password input -->
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

            <!-- Input field for confirming the new password -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation"
                          required autocomplete="new-password"/>

            <!-- Display validation error messages for the confirm password field -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
