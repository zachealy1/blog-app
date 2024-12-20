{{-- resources/views/users/show.blade.php --}}
<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <!-- Display user's full name in the header -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->first_name }} {{ $user->last_name }}'s Profile
        </h2>
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Profile Overview</h3>
                    <p><strong>Full Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- User's Posts Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Posts</h3>
                    @if ($posts->count())
                        <!-- List of user's posts -->
                        <ul class="list-disc pl-6">
                            @foreach ($posts as $post)
                                <li class="mb-2">
                                    <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">
                                        {{ $post->title }}
                                    </a>
                                    <small class="text-gray-600">
                                        (Posted on {{ $post->created_at->format('F j, Y') }})
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <!-- Message when no posts are available -->
                        <p>No posts yet.</p>
                    @endif
                </div>
            </div>

            <!-- User's Comments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Comments</h3>
                    @if ($comments->count())
                        <!-- List of user's comments -->
                        <ul class="list-disc pl-6">
                            @foreach ($comments as $comment)
                                <li class="mb-4">
                                    <!-- Comment body -->
                                    <p class="mb-1">{{ $comment->body }}</p>
                                    <!-- Link to the related post -->
                                    <small class="text-gray-600">
                                        Commented on:
                                        <a href="{{ route('posts.show', $comment->post) }}"
                                           class="text-blue-500 hover:underline">
                                            {{ $comment->post->title }}
                                        </a>
                                        ({{ $comment->created_at->format('F j, Y, g:i a') }})
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <!-- Message when no comments are available -->
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
