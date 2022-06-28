<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index() {

        return view('courses.index', [
            'courses' => Course::filter(request(['search']))->paginate(10),
        ]);
    }
    
    public function create() {
        return view('courses.create', [
            'categories' => Category::get(),
            'levels' => Level::get(),
        ]);
    }

    public function store(Request $request) {

        $attributes = $request->validate([
            'title' => ['required','min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'category_id' => [
                'required',
                'exists:App\Models\Category,id',
            ],
            'level_id' => [
                'required',
                'exists:App\Models\Level,id'
            ],
        ]);

        $attributes += ['user_id' => Auth::id()];
        
        Course::create($attributes);

        return back()->with('success', 'Course created successfully.');
    }

    public function edit(Course $course) {

        return view('courses.edit', [
            'course' => $course,
            'categories' => Category::get(),
            'levels' => Level::get(),

        ]);
    }

    public function update(Request $request, Course $course) {
        
        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
            'category_id' => [
                'required',
                'exists:App\Models\Category,id',
            ],
            'level_id' => [
                'required',
                'exists:App\Models\Level,id'
            ],
        ]);

        ($request->certificate == 1)? $attributes += ['certificate' => 1] : $attributes += ['certificate' => 0];
        
        $course->update($attributes);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function delete(Course $course) {
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
