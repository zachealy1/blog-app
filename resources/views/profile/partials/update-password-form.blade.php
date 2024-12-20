<section>
    <!-- Section Header -->
    <header>
        <!-- Title -->
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <!-- Instruction -->
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Password Update Form -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf <!-- CSRF Protection -->
        @method('put') <!-- HTTP PUT method -->

        <!-- Current Password -->
        <div>
            <!-- Label for Current Password -->
            <x-input-label for="update_password_current_password" :value="__('Current Password')"/>

            <!-- Current Password Input -->
            <x-text-input id="update_password_current_password"
                          name="current_password"
                          type="password"
                          class="mt-1 block w-full"
                          autocomplete="current-password"/>

            <!-- Validation Error for Current Password -->
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2"/>
        </div>

        <!-- New Password -->
        <div>
            <!-- Label for New Password -->
            <x-input-label for="update_password_password" :value="__('New Password')"/>

            <!-- New Password Input -->
            <x-text-input id="update_password_password"
                          name="password"
                          type="password"
                          class="mt-1 block w-full"
                          autocomplete="new-password"/>

            <!-- Validation Error for New Password -->
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div>
            <!-- Label for Confirm Password -->
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"/>

            <!-- Confirm Password Input -->
            <x-text-input id="update_password_password_confirmation"
                          name="password_confirmation"
                          type="password"
                          class="mt-1 block w-full"
                          autocomplete="new-password"/>

            <!-- Validation Error for Confirm Password -->
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4">
            <!-- Save Button -->
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- Success Message -->
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
