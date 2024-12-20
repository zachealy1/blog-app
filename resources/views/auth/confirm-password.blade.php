<x-guest-layout>
    <!-- Informational message -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <!-- Password confirmation form -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf <!-- CSRF protection token to prevent cross-site request forgery -->

        <!-- Password Input Field -->
        <div>
            <!-- Label for the password field -->
            <x-input-label for="password" :value="__('Password')"/>

            <!-- Password input -->
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <!-- Error message for invalid password -->
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirmation Button -->
        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
