<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class CourseUnitController extends Controller
{
    public function create(Course $course) {
        
        return view('courses.units.create', [
            'course' => $course,
        ]);
    }

    public function store(Request $request, Course $course) {
        $attributes = request()->validate([
            'title' => ['required','min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
        ]);

        Unit::create($attributes);

        if($request->has('create_another')) {
            return back()->with('success', 'Unit created successfully.');
        }
        return redirect()->route('courses.show',$course)->with('success', 'Unit created successfully.');
    }

    public function edit(Course $course, Unit $unit) {

        return view('courses.units.edit', [
            'unit' => $unit,
            'course' => $course,
        ]);
    }

    public function delete(Course $course, Unit $unit) {

        $unit->delete();

        return back()->with('success', 'Unit deleted successfully.');
    }
}
