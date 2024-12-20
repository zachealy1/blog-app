<x-guest-layout>
    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf <!-- CSRF token for security -->

        <!-- First Name -->
        <div class="mb-4">
            <!-- Label for first name input -->
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>

            <!-- Input field for first name -->
            <input id="first_name" type="text" name="first_name"
                   value="{{ old('first_name') }}" required
                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-500">

            <!-- Validation error for first name -->
            @error('first_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <!-- Label for last name input -->
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>

            <!-- Input field for last name -->
            <input id="last_name" type="text" name="last_name"
                   value="{{ old('last_name') }}" required
                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-500">

            <!-- Validation error for last name -->
            @error('last_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <!-- Label for email input -->
            <x-input-label for="email" :value="__('Email')"/>

            <!-- Input field for email -->
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email"
                          :value="old('email')" required autocomplete="username"/>

            <!-- Validation error for email -->
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <!-- Label for password input -->
            <x-input-label for="password" :value="__('Password')"/>

            <!-- Input field for password -->
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password"
                          required autocomplete="new-password"/>

            <!-- Validation error for password -->
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <!-- Label for confirm password input -->
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

            <!-- Input field for confirm password -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation"
                          required autocomplete="new-password"/>

            <!-- Validation error for confirm password -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Additional Actions -->
        <div class="flex items-center justify-end mt-4">
            <!-- Link to login page -->
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <!-- Submit button for registration -->
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
