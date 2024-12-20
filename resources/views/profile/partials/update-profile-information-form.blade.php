<section>
    <!-- Section Header -->
    <header>
        <!-- Title -->
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <!-- Description -->
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Form to Send Email Verification -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf <!-- CSRF token for security -->
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf <!-- CSRF protection -->
        @method('patch') <!-- HTTP PATCH method for partial updates -->

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')"/>
            <x-text-input
                id="first_name"
                name="first_name"
                type="text"
                class="mt-1 block w-full"
                :value="old('first_name', $user->first_name)"
                required
                autofocus
                autocomplete="given-name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Last Name')"/>
            <x-text-input
                id="last_name"
                name="last_name"
                type="text"
                class="mt-1 block w-full"
                :value="old('last_name', $user->last_name)"
                required
                autocomplete="family-name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            <!-- Email Verification Notice -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <!-- Unverified Email Notice -->
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <!-- Re-send Verification Email Button -->
                        <button
                            form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    <!-- Success Message for Resending Verification Link -->
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button and Status Message -->
        <div class="flex items-center gap-4">
            <!-- Save Button -->
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- Success Message -->
            @if (session('status') === 'profile-updated')
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
