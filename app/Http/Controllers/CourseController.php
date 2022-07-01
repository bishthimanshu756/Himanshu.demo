<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Category $category, Level $level)
    {
        return view('courses.index', [
            'courses' => Course::courseOwner()
                ->filter(request(['search', 'category', 'orderBy', 'level']))
                ->paginate(),
            'categories' => $category->get(),
            'currentCategory' => $category->find(request()->category),
            'levels' => $level->get(),
            'currentLevel' => $level->find(request()->level),
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'categories' => Category::get(),
            'levels' => Level::get(),
        ]);
    }

    public function store(Request $request)
    {
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

        $attributes += [
            'user_id' => Auth::id()
        ];

        Course::create($attributes);

        return back()->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $this->authorize('edit', $course);

        return view('courses._course_information', [
            'course' => $course,
            'categories' => Category::get(),
            'levels' => Level::get(),

        ]);
    }

    public function show(Course $course)
    {
        $this->authorize('show', $course);

        return view('courses.units.index', [
            'course' => $course,
            'units' => $course->units()->get(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

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
            $path = $request->image->store('images');
            Image::create([
                'image_path' => $path,
                'course_id' => $course->id
            ]);
        }

        return back()->with('success', 'Course updated successfully.');
    }

    public function delete(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
