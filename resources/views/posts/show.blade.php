<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
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

            <!-- Profile Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <!-- User's Name with a Link to Their Posts and Comments -->
                    <h4 class="font-semibold mb-0">
                        <a href="{{ route('users.show', $post->user) }}" class="text-blue-500 hover:underline">
                            {{ $post->user->first_name }} {{ $post->user->last_name }}
                        </a>
                    </h4>
                    <p class="text-muted mb-0">Member since: {{ $post->user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Post Content Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <!-- Title and Buttons -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="font-semibold text-2xl">{{ $post->title }}</h1>
                        <div class="flex">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md mr-2">
                                    Edit
                                </a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md"
                                            onclick="return confirm('Are you sure you want to delete this post?');">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <!-- Display Image -->
                    @if ($post->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 alt="Post Image"
                                 class="block mx-auto rounded-lg shadow-md"
                                 style="width: 300px; height: auto;">
                        </div>
                    @endif

                    <!-- Post Content -->
                    <p>{{ $post->content }}</p>
                    <div class="text-sm text-gray-500">
                        <small>Posted on: {{ $post->created_at->format('F j, Y, g:i a') }}</small>
                        <small class="block">Views: {{ $post->views->count() }}</small>
                        <small class="block">Comments: {{ $post->comment_count }}</small>
                    </div>
                </div>
            </div>

            <!-- Like Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    @auth
                        <div id="like-section" class="flex items-center">
                            <button id="like-btn" data-post-id="{{ $post->id }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-md shadow-md">
                                {{ $post->likes->where('user_id', auth()->id())->isNotEmpty() ? 'Unlike' : 'Like' }}
                            </button>
                            <span id="like-count" class="ml-4 text-gray-600">{{ $post->likes->count() }}</span>&nbsp;Likes
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Comments</h3>
                    @if($post->comments->count())
                        <ul class="list-disc pl-4">
                            @foreach($post->comments as $comment)
                                <li class="mb-3">
                                    <p>{{ $comment->body }}</p>
                                    <small class="text-gray-600">By
                                        <a href="{{ route('users.show', $comment->user) }}"
                                           class="text-blue-500 hover:underline">
                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        </a>
                                        on {{ $comment->created_at->format('F j, Y, g:i a') }}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No comments yet.</p>
                    @endif
                </div>
            </div>

            <!-- Add Comment Form -->
            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Add a Comment</h3>
                        <form method="POST" action="{{ route('comments.store', $post) }}">
                            @csrf
                            <textarea name="body" rows="4"
                                      class="w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-blue-300"
                                      required>{{ old('body') }}</textarea>
                            @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md mt-4">
                                Submit Comment
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>

    <!-- JavaScript to Handle Likes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const likeButton = document.getElementById('like-btn');
            const likeCount = document.getElementById('like-count');

            likeButton.addEventListener('click', function () {
                const postId = likeButton.getAttribute('data-post-id');
                fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({}),
                })
                    .then(response => response.json())
                    .then(data => {
                        likeCount.textContent = data.likeCount;
                        likeButton.textContent = data.liked ? 'Unlike' : 'Like';
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>
