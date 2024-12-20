<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-12">
        <!-- Responsive Container -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Title -->
                    <h3 class="font-semibold text-lg mb-4">Your Notifications</h3>

                    <!-- Notifications List -->
                    <ul class="list-group">
                        <!-- Loop through each notification -->
                        @forelse($notifications as $notification)
                            <li class="list-group-item">
                                <!-- Display the notification message -->
                                <p>{{ $notification->data['message'] }}</p>
                                <!-- Display how long ago the notification was created -->
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </li>
                        @empty
                            <!-- Fallback if there are no notifications -->
                            <li class="list-group-item">
                                <p>No new notifications.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
