@extends('layouts.app')

@section('content')
<div>
    <h1>Course Students</h1>
    <a href="{{ route('course_students.create') }}">Add New</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>User</th>
                <th>Creator</th>
                <th>Editor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseStudents as $courseStudent)
                <tr>
                    <td>{{ $courseStudent->id }}</td>
                    <td>{{ $courseStudent->course->name ?? 'N/A' }}</td>
                    <td>{{ $courseStudent->user->name ?? 'N/A' }}</td>
                    <td>{{ $courseStudent->creator }}</td>
                    <td>{{ $courseStudent->editor }}</td>
                    <td>
                        <a href="{{ route('course_students.edit', $courseStudent->id) }}">Edit</a>
                        <form action="{{ route('course_students.destroy', $courseStudent->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
