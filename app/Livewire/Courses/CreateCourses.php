<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class CreateCourses extends Component
{
    use WithFileUploads;

    public $name = '';
    public $description = '';
    public $image;
    public $price = 0;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required',
        'image' => 'nullable|image|max:1024',
        'price' => 'required|numeric|min:0',
        'is_active' => 'boolean',
    ];

    public function render()
    {
        return view('livewire.courses.create-courses')->extends('layouts.master');
    }

    public function store(FlasherInterface $flasher)
    {
        try {
            $this->validate();

            // Create slug from name
            $slug = Str::slug($this->name);
            $originalSlug = $slug;
            $count = 1;

            // Check if slug exists and generate a unique one
            while (Course::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $imagePath = null;
            if ($this->image) {
                $imagePath = $this->image->store('courses', 'public');
            }

            Course::create([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description,
                'image' => $imagePath,
                'price' => $this->price,
                'is_active' => $this->is_active,
                'user_id' => Auth::id(),
                'creator' => Auth::id(),
            ]);

            // Success Message
            $flasher->addSuccess('Course created successfully!');

            // Reset the form
            $this->reset(['name', 'description', 'image', 'price', 'is_active']);

            // Redirect to courses list or show page
            return redirect()->route('courses.index');

        } catch (\Exception $e) {
            $flasher->addError('Something went wrong! ' . $e->getMessage());
        }
    }
}
