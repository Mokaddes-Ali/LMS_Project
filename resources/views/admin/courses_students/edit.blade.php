@extends('layouts.master')

@section('content')
<div>
    <h1>{{ isset($courseStudent) ? 'Edit Record' : 'Add New Record' }}</h1>
    <form action="{{ isset($courseStudent) ? route('course_students.update', $courseStudent->id) : route('course_students.store') }}" method="POST">
        @csrf
        @if(isset($courseStudent)) @method('PUT') @endif
        <div>
            <label for="course_id">Course</label>
            <input type="number" name="course_id" value="{{ $courseStudent->course_id ?? '' }}" required>
        </div>
        <div>
            <label for="user_id">User</label>
            <input type="number" name="user_id" value="{{ $courseStudent->user_id ?? '' }}" required>
        </div>
        <button type="submit">{{ isset($courseStudent) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
