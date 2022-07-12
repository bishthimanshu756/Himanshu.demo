<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('tests.create', [
            'course' => $course,
            'unit' => $unit
        ]);
    }

    public function store(Request $request, Course $course, Unit $unit)
    {
        $attributes = $request->validate([
            'name' => ['required','min:3' ,'max:50'],
            'pass_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'duration' => ['required', 'numeric', 'min:0'],
        ]);

        $test = Test::create($attributes);

        $lesson = Lesson::make([
            'name' => $test->name,
            'unit_id' => $unit->id,
        ]);

        $lesson->lessonable()->associate($test);

        $lesson->save();

        if($request->action == 'save'){
            return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])
                    ->with('success', __('Test created successfully.'));
        }

        return back()->with('success', __('Test created successfully.'));

    }

    public function edit(Course $course, Test $test)
    {
        return view('tests.edit',[
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
            'questions' => $test->questions()->get(),
        ]);
    }

    public function update(Course $course, Test $test, Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'pass_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'duration' => ['required', 'numeric', 'min:0'],
        ]);

        $test->update([
            'name' => $request->name,
            'pass_percentage' => $request->pass_percentage,
            'duration' => $request->duration,
        ]);

        $test->lesson->name =  $test->name;
        $test->lesson->save();

        return back()->with('success', __('Test updated successfully.'));
    }
}
