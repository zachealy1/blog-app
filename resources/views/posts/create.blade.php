<!DOCTYPE html>
<html>
<head>
    <title>Create New Post</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Page Title -->
    <h1>Create New Post</h1>

    <!-- Form for creating a new post -->
    <!-- "enctype=multipart/form-data" is required to handle file uploads -->
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf <!-- CSRF protection token -->

        <!-- Title Input -->
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <!-- Input field for the post title -->
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ old('title') }}" required>
            <!-- Display validation errors for the title -->
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content Input -->
        <div class="form-group mb-3">
            <label for="content">Content</label>
            <!-- Textarea for the post content -->
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            <!-- Display validation errors for the content -->
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-3">
            <label for="image">Upload Image</label>
            <!-- Input for selecting an image file -->
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            <!-- Display validation errors for the image -->
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
