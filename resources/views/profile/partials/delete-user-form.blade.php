<section class="space-y-6">
    <!-- Section Header -->
    <header>
        <!-- Title -->
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <!-- Warning Message -->
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Account Button -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
    {{ __('Delete Account') }}
    </x-danger-button>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <!-- Form for account deletion -->
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf <!-- CSRF protection token -->
            @method('delete') <!-- Spoof HTTP DELETE method -->

            <!-- Modal Title -->
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <!-- Modal Warning Message -->
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <!-- Password Input -->
            <div class="mt-6">
                <!-- Label (hidden for screen readers) -->
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only"/>

                <!-- Password Field -->
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <!-- Validation Error for Password -->
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2"/>
            </div>

            <!-- Modal Buttons -->
            <div class="mt-6 flex justify-end">
                <!-- Cancel Button -->
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <!-- Confirm Deletion Button -->
                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
