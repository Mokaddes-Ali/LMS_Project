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

    // public function store(Request $request)
    // {
    //     // Validation
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'slug' => 'required|string|max:255|unique:courses',
    //         'description' => 'required|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'price' => 'required|numeric|min:0',
    //         'is_active' => 'required|in:1,2', // Ensures it is either 'Active' or 'Inactive'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Handle Image Upload with Random Name
    //     $image_rename = '';
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $ext = $image->getClientOriginalExtension();
    //         $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
    //         // Move image to public/images directory
    //         $image->move(public_path('images'), $image_rename);
    //     }

    //     // Create Course
    //     Course::create([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //         'description' => $request->description,
    //         'image' => 'images/' . $image_rename, // Storing relative path
    //         'price' => $request->price,
    //         'user_id' => auth()->id(),
    //         'creator' => auth()->id(),
    //         'is_active' => $request->is_active == '1' ? true : false, // Convert 1 to true and 2 to false
    //     ]);

    //     return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    // }


    public function store(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:courses',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'price' => 'required|numeric|min:0',
        'is_active' => 'required|in:1,2', // Ensures it is either 'Active' or 'Inactive'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Handle Image Upload with Random Name
    $image_rename = '';
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        // Move image to public/images directory
        $image->move(public_path('images'), $image_rename);
    }

    // Create Course
    Course::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
        'image' => $image_rename ? 'images/' . $image_rename : null, // Storing relative path, or null if no image
        'price' => $request->price,
        'user_id' => auth()->id(),
        'creator' => auth()->id(),
        'is_active' => $request->is_active == '1', // Convert '1' to true, '2' to false
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
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|in:1,2',
        ]);

        // Handle Old Image
        $oldImage = $course->image;
        $imageRename = $oldImage;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageRename = time() . '_' . rand(100000, 10000000) . '.' . $ext;

            // Delete the old image if it exists
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            // Upload new image
            $image->move(public_path('images'), $imageRename);
            $imageRename = 'images/' . $imageRename; // Store relative path
        }

        // Update Course
        $update = $course->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imageRename,
            'price' => $request->price,
            'editor' => auth()->id(),
            'is_active' => $request->is_active == '1' ? true : false,
        ]);

        // Response
        if ($update) {
            return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
        } else {
            return back()->with('fail', 'Course update failed.');
        }
    }

    public function destroy(Course $course)
    {
        // Delete the image file from storage if it exists
        if ($course->image && file_exists(public_path($course->image))) {
            unlink(public_path($course->image));
        }

        // Delete the course
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
