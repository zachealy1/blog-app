{{-- resources/views/dashboard.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Page Title -->
    <h1 class="mb-4">Dashboard</h1>

    <!-- Section Title -->
    <h2>All Posts</h2>

    <!-- Check if there are any posts -->
    @if($posts->count())
        <!-- List of posts -->
        <div class="list-group">
            @foreach ($posts as $post)
                <!-- Each post is a clickable link to its detail page -->
                <a href="{{ route('posts.show', $post) }}" class="list-group-item list-group-item-action">
                    <!-- Post title -->
                    <h5 class="mb-1">{{ $post->title }}</h5>
                    <!-- Author name and post creation date -->
                    <small class="text-muted">
                        By {{ $post->user->first_name }} {{ $post->user->last_name }} -
                        {{ $post->created_at->format('F j, Y, g:i a') }}
                    </small>
                </a>
            @endforeach
        </div>
    @else
        <!-- Message when no posts are available -->
        <div class="alert alert-info mt-3">No posts available.</div>
    @endif
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
