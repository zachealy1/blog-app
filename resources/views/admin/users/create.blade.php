<x-app-layout>
    <!-- Header section of the page -->
    <x-slot name="header">
        <!-- Page title displayed in a prominent style -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <!-- Main content section -->
    <div class="py-12">
        <!-- Content container with responsive width -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card-like container for the form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Form container with padding and styling -->
                <div class="p-6 text-gray-900">

                    <!-- Display validation errors if present -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <!-- Loop through and display each error -->
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- User creation form -->
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf <!-- CSRF protection token -->

                        <!-- First Name Input Field -->
                        <div class="mb-4">
                            <label for="first_name" class="block font-bold">First Name:</label>
                            <input type="text" id="first_name" name="first_name" class="form-input mt-1 block w-full"
                                   required>
                        </div>

                        <!-- Last Name Input Field -->
                        <div class="mb-4">
                            <label for="last_name" class="block font-bold">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" class="form-input mt-1 block w-full"
                                   required>
                        </div>

                        <!-- Email Input Field -->
                        <div class="mb-4">
                            <label for="email" class="block font-bold">Email:</label>
                            <input type="email" id="email" name="email" class="form-input mt-1 block w-full" required>
                        </div>

                        <!-- Password Input Field -->
                        <div class="mb-4">
                            <label for="password" class="block font-bold">Password:</label>
                            <input type="password" id="password" name="password" class="form-input mt-1 block w-full"
                                   required>
                        </div>

                        <!-- Confirm Password Input Field -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block font-bold">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-input mt-1 block w-full" required>
                        </div>

                        <!-- Is Admin Dropdown -->
                        <div class="mb-4">
                            <label for="admin" class="block font-bold">Is Admin:</label>
                            <select id="admin" name="admin" class="form-input mt-1 block w-full">
                                <!-- Options for admin status -->
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">
                            Create User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
