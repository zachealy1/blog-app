<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 text-lg font-medium">
                    {{ __('Welcome, ') . Auth::user()->first_name }} 🎉
                </div>
            </div>

            <!-- Prominent Add Post Button -->
            <div class="text-center mb-6">
                <a href="{{ route('posts.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md mr-2">
                    <i class="fas fa-plus mr-2"></i> Add New Post
                </a>
            </div>

            <!-- All Posts Section -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-6">All Posts</h3>
                    @if($posts->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($posts as $post)
                                <div class="bg-white border rounded-lg shadow-md hover:shadow-lg transition">
                                    <div class="p-4 flex flex-col h-full">
                                        <h5 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h5>
                                        <p class="text-sm text-gray-500 mb-4">
                                            By
                                            <a href="{{ route('users.show', $post->user) }}" class="text-blue-500 hover:underline">
                                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                                            </a>
                                            - {{ $post->created_at->format('F j, Y, g:i a') }}
                                        </p>
                                        <p class="text-gray-700 flex-grow">
                                            {{ Str::limit($post->content, 100) }}
                                        </p>
                                        <div class="mt-4">
                                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary w-full">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-3">
                            No posts available. Start by adding your first post!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
