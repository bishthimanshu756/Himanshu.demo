<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Category $category, Level $level) {

        return view('courses.index', [
            'courses' => Course::filter(request(['search', 'category', 'orderBy', 'level']))->paginate(10),
            'categories' => $category->get(),
            'currentCategory' => $category->find(request()->category),
            'levels' => $level->get(),
            'currentLevel' => $level->find(request()->level),
        ]);
    }

    public function show(Course $course) {
        return view('courses.units.index', [
            'course' => $course,
            'units' => Unit::get(),
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
        
        if(request()->file('image')) {
            $path = $request->image->store('public/images');
            Image::create([
                'image_path' => $path,
                'course_id' => $course->id
            ]);
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function delete(Course $course) {
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
