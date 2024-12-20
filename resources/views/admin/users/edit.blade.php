<x-app-layout>
    <!-- Header section of the page -->
    <x-slot name="header">
        <!-- Display the user's full name being edited -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User: {{ $user->first_name }} {{ $user->last_name }}
        </h2>
    </x-slot>

    <!-- Main content section -->
    <div class="py-12">
        <!-- Centered container with responsive design -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card-like container for the form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- User edit form -->
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf <!-- CSRF protection token -->
                        @method('PUT') <!-- HTTP PUT method for updating -->

                        <!-- First Name Input Field -->
                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                   value="{{ old('first_name', $user->first_name) }}"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <!-- Display validation error if present -->
                            @error('first_name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name Input Field -->
                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                   value="{{ old('last_name', $user->last_name) }}"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @error('last_name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input Field -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">Leave blank to keep the current password.</p>
                        </div>

                        <!-- Confirm Password Input Field -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @error('password_confirmation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Checkbox -->
                        <div class="mb-4 flex items-center">
                            <!-- Hidden input ensures "admin" is set to 0 if the checkbox is unchecked -->
                            <input type="hidden" name="admin" value="0">
                            <input type="checkbox" name="admin" id="admin" value="1" class="mr-2"
                                {{ $user->admin ? 'checked' : '' }}>
                            <label for="admin" class="block text-sm font-medium text-gray-700">Admin</label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <!-- Cancel button redirects to the admin dashboard -->
                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                Cancel
                            </a>
                            <!-- Submit button to update the user -->
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
