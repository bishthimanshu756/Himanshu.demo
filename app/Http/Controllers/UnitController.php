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
            'description' => ['required', 'min:5'],
        ]);

        $unit = Unit::create($attributes);

        $course->units()->attach($unit->id);

        if($request->action == 'save')
        {
            return redirect()->route('courses.units.edit', [$course, $unit])
                ->with('success', __('Unit created successfully.'));
        }

        return back()->with('success', __('Unit created successfully.'));
    }

    public function edit(Course $course, Unit $unit)
    {
        $this->authorize('edit', $course);

        return view('units.edit', [
            'unit' => $unit,
            'course' => $course,
            'lessons' => $unit->lessons()->get(),
        ]);
    }

    public function update( Request $request, Course $course,Unit $unit)
    {
        $this->authorize('update', $course);

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:5'],
        ]);

        $unit->update($attributes);

        return redirect()->route('courses.show', $course)
            ->with('success', __('Unit updated successfully.'));
    }

    public function delete(Course $course, Unit $unit)
    {
        $this->authorize('delete', $course);

        $unit->delete();

        return back()->with('success', __('Unit deleted successfully.'));
    }
}
