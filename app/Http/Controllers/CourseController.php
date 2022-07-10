<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Category $category, Level $level)
    {
        $course = Course::visibleTo()
                ->filter(request(['search', 'category', 'orderBy', 'level']))
                ->paginate();

        return view('courses.index', [
            'courses' => $course,
            'currentCategory' => $category->find(request()->category),
            'currentLevel' => $level->find(request()->level),
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }
    
    public function store(Request $request)
    {
        // dd(request()->file('image')->getClientOriginalName());
        $validator = Validator::make($request->all(), [
            'category_id' => [
                'required',
                Rule::exists('categories','id'),
            ],
            'level_id' => [
                'required',
                Rule::exists('levels', 'id'),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('Please select valid Category and Level.'));
        };

        $validated = $validator->validated();

        $attributes = $request->validate([
            'title' => ['required','min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
        ]);

        $attributes += [
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'level_id' => $validated['level_id'],
        ];

        $course = Course::create($attributes);

        if($request->file('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->image->storeAs('images', $filename);
            Image::create([
                'image_path' => $path,
                'course_id' => $course->id
            ]);
        }

        return back()->with('success', __('Course created successfully.') );
    }

    public function edit(Course $course)
    {
        $this->authorize('edit', $course);

        return view('courses._course_information', [
            'course' => $course,
        ]);
    }

    public function show(Course $course)
    {
        $this->authorize('show', $course);

        return view('courses.show', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validator = Validator::make($request->all(), [
            'category_id' => ['required',
                Rule::exists('categories', 'id'),
            ],
            'level_id' => [
                'required',
                Rule::exists('levels', 'id'),
            ],
        ]);

        if($validator->fails()) {
            return back()->with('error', 'Please select valid Category and Level.');
        }

        $validated = $validator->validated();

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
        ]);

        $attributes += [
            'category_id' => $validated['category_id'],
            'level_id' => $validated['level_id'],
            'certificate' => ($request->certificate == 1)? 1 : 0,
        ];

        $course->update($attributes);

        if(request()->file('image')) {
            $path = $request->image->store('public/images');
            Image::create([
                'image_path' => $path,
                'course_id' => $course->id
            ]);
        }

        return back()->with('success', __('Course updated successfully.') );
    }

    public function delete(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return back()->with('success', __('Course deleted successfully.') );
    }
}
