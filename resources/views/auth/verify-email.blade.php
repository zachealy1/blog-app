<x-guest-layout>
    <!-- Informational Message -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    <!-- Success Message -->
    <!-- Display a success message if a new verification link has been sent -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="mt-4 flex items-center justify-between">
        <!-- Resend Verification Email Form -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf <!-- CSRF protection token -->

            <div>
                <!-- Button to resend the verification email -->
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Log Out Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF protection token -->

            <!-- Button to log out the user -->
            <button type="submit"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
