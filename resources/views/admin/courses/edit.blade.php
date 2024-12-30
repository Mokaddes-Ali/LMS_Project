@extends('layouts.master')

@section('content')
<div class="container">
    <h3 class="text-center">Edit Course</h3>
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
        </div>

        <!-- Slug -->
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $course->slug }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $course->description }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            @if ($course->image)
                <div class="mt-2">
                    <img id="imagePreview" src="{{ asset($course->image) }}" alt="Current Image" style="width: 150px; height: 50px;">
                </div>
            @else
                <div id="imagePreview" style="display:none;"></div>
            @endif
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $course->price }}" required>
        </div>

        <!-- Active Status -->
        <div class="mb-3">
            <label for="is_active" class="form-label">Active Status</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ $course->is_active ? 'selected' : '' }}>Active</option>
                <option value="2" {{ !$course->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<script>
    // Image preview function
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show preview
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
