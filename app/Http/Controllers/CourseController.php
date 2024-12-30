<?php


namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.show', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.add');
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle Image Upload with Random Name
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'courses', // Directory
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(), // Random name
                'public' // Storage disk
            );
        }

        // Create Course
        Course::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
            'price' => $request->price,
            'user_id' => auth()->id(),
            'creator' => auth()->id(),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }


    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:courses,slug,' . $course->id,
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'price' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Handle Image Upload with Random Name
    $imagePath = $course->image; // Keep existing image if no new image uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->storeAs(
            'courses', // Directory
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(), // Random name
            'public' // Storage disk
        );
    }

    // Update Course
    $course->update([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
        'image' => $imagePath,
        'price' => $request->price,
        'editor' => auth()->id(),
    ]);

    return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
}


    public function destroy(Course $course)
    {
        if ($course->image) {
            // Delete the image file from storage
            \Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
