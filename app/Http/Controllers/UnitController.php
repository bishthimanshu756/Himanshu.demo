<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Unit;

class UnitController extends Controller
{
    public function create(Course $course)
    {
        return view('units.create', [
            'course' => $course,
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $attributes = $request->validate([
            'title' => ['required','min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
        ]);

        $unit = Unit::create($attributes);

        $course->units()->attach($unit->id);

        if($request->has('create_another'))
        {
            return back()->with('success', __('Unit created successfully.'));
        }
        return redirect()->route('courses.show', $course)
            ->with('success', __('Unit created successfully.'));
    }

    public function edit(Course $course, Unit $unit)
    {
        return view('units.edit', [
            'unit' => $unit,
            'course' => $course,
            'lessons' => $unit->lessons()->get(),
        ]);
    }

    public function update(Course $course,Unit $unit, Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:255'],
        ]);

        $unit->update($attributes);

        return redirect()->route('courses.show', $course)
            ->with('success', __('Unit updated successfully.'));
    }

    public function delete(Course $course, Unit $unit)
    {
        $unit->delete();

        return back()->with('success', __('Unit deleted successfully.'));
    }
}