<x-app-layout>
    <!-- Header section of the page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content section -->
    <div class="py-12">
        <!-- Centered container with responsive design -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card-like container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Section Title -->
                    <h3 class="font-semibold text-lg mb-4">All Users</h3>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <!-- Success message -->
                        <div
                            class="alert alert-success mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <!-- Error message -->
                        <div
                            class="alert alert-danger mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Create User Button -->
                    <div class="mb-4">
                        <a href="{{ route('admin.users.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md">
                            Create New User
                        </a>
                    </div>

                    <!-- User Table -->
                    <table class="table-auto w-full">
                        <!-- Table Headers -->
                        <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">First Name</th>
                            <th class="px-4 py-2">Last Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <!-- User ID -->
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <!-- First Name -->
                                <td class="border px-4 py-2">{{ $user->first_name }}</td>
                                <!-- Last Name -->
                                <td class="border px-4 py-2">{{ $user->last_name }}</td>
                                <!-- Email -->
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <!-- Action Buttons -->
                                <td class="border px-4 py-2 text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md inline-block text-center"
                                       style="width: 100px;">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          style="display: inline-block;">
                                        @csrf <!-- CSRF Protection -->
                                        @method('DELETE') <!-- Method Spoofing -->
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-md text-center"
                                                style="width: 100px;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
