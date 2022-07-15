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
            'pass_percentage' => ['required', 'numeric', 'min:1', 'max:100'],
            'duration' => ['required', 'numeric', 'min:0'],
        ]);

        $test = Test::create($attributes);

        $lesson = Lesson::make([
            'name' => $test->name,
            'unit_id' => $unit->id,
            'duration' => $test->duration,
        ]);

        $lesson->lessonable()->associate($test);

        $lesson->save();

        $unit->increment('duration', $lesson->duration);
        $unit->increment('lesson_count');

        if($request->action == 'save') {
            return redirect()->route('courses.tests.edit', [$course, $test])
                    ->with('success', __('Test created successfully.'));
        }

        return back()->with('success', __('Test created successfully.'));

    }

    public function edit(Course $course, Test $test)
    {
        $this->authorize('edit', $course);

        return view('tests.edit',[
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
            'questions' => $test->questions()->get(),
        ]);
    }

    public function update(Request $request, Course $course, Test $test)
    {
        $this->authorize('update', $course);

        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'pass_percentage' => ['required', 'numeric', 'min:1', 'max:100'],
            'duration' => ['required', 'numeric', 'min:0'],
        ]);

        $test->update([
            'name' => $request->name,
            'pass_percentage' => $request->pass_percentage,
            'duration' => $request->duration,
        ]);

        /** Updating Lesson */
        $test->lesson->name =  $test->name;
        $test->lesson->duration = $test->duration;
        $test->lesson->save();

        $test->lesson->unit->increment('duration', $test->duration);

        return back()->with('success', __('Test updated successfully.'));
    }
}
