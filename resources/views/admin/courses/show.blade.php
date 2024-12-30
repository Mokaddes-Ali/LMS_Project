@extends('layouts.master')

@section('content')
<div class="container">
    <h3 class="text-center display-5 mb-1">Courses List</h3>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Add New Course</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Courses Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th> <!-- Added Status Column -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->slug }}</td>
                    <td>${{ $course->price }}</td>
                    <td>
                        @if ($course->image)
                            <!-- Small image styling -->
                            <img src="{{ asset($course->image) }}" alt="Course Image" style="width: 150px; height: 50px;" >
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <!-- Displaying the status with color -->
                        <span class="badge" style="background-color: {{ $course->is_active ? 'green' : 'red' }}; color: white;">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Hover effect on table rows */
    tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Add shadow to table cells */
    td, th {
        vertical-align: middle;
        text-align: center;
    }

    /* Add some margin for the title */
    h1 {
        font-size: 2.5rem;
    }
</style>
@endsection

