<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    // List All Records
    public function index()
    {
        $courseStudents = CourseStudent::with(['course', 'user'])->get();
        return view('admin.course_students.index', compact('courseStudents'));
    }

    // Show Create Form
    public function create()
    {
        return view('admin.courses_students.create');
    }

    // Store Record
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ]);

        CourseStudent::create([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'creator' => auth()->id(),
        ]);

        return redirect()->route('course_students.index')->with('success', 'Record created successfully!');
    }

    // Show Edit Form
    public function edit(CourseStudent $courseStudent)
    {
        return view('course_students.edit', compact('courseStudent'));
    }

    // Update Record
    public function update(Request $request, CourseStudent $courseStudent)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $courseStudent->update([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'editor' => auth()->id(),
        ]);

        return redirect()->route('course_students.index')->with('success', 'Record updated successfully!');
    }

    // Delete Record
    public function destroy(CourseStudent $courseStudent)
    {
        $courseStudent->delete();

        return redirect()->route('course_students.index')->with('success', 'Record deleted successfully!');
    }
}

