<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <!-- Main Content Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Edit Post Form -->
                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF Protection -->
                        @method('PUT') <!-- Spoof HTTP PUT Method -->

                        <!-- Title Input -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                   value="{{ old('title', $post->title) }}" required
                                   class="form-input mt-1 block w-full">
                            <!-- Validation Error -->
                            @error('title')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content Input -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="5" required
                                      class="form-textarea mt-1 block w-full">{{ old('content', $post->content) }}</textarea>
                            <!-- Validation Error -->
                            @error('content')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Photo Section -->
                        @if($post->image)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Current Photo</label>
                                <!-- Display the existing image -->
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Photo" class="w-1/3 mt-2">
                                <!-- Option to Remove the Image -->
                                <div class="mt-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="remove_photo" class="form-checkbox">
                                        <span class="ml-2 text-sm text-gray-700">Remove this photo</span>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <!-- Upload New Photo -->
                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Upload New Photo</label>
                            <input type="file" name="photo" id="photo"
                                   class="form-input mt-1 block w-full">
                            <!-- Validation Error -->
                            @error('photo')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Buttons -->
                        <div class="flex justify-between">
                            <!-- Cancel Button -->
                            <a href="{{ route('posts.show', $post) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                Cancel
                            </a>
                            <!-- Submit Button -->
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
