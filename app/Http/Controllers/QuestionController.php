<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Course $course, Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'test' => $test,
        ]);
    }

    public function store(Course $course, Unit $unit, Test $test, Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'option1' => ['required', 'min:3', 'max:50'],
            'option2' => ['required', 'min:3', 'max:50'],
            'answer' => ['required', 'min:1'],
        ]);

        $question = Question::create([
            'name' => $request->name,
        ]);

        $test->questions()->attach($question);

        $question->options()->attach($question, [
            'name' => $request->option1,
            'is_answer' => $request->answer == 'option1' ? '1':'0',
        ], [
            'name' => $request->option1,
            'is_answer' => $request->answer == 'option2' ? '1':'0',
        ]);

        return redirect()->route('courses.tests.questions.edit', [$course, $test, $question])
            ->with('success', __('Question created successfully.'));
    }

    public function edit(Course $course, Test $test, Question $question)
    {
        return view('questions.edit', [
            'course' => $course,
            'test' => $test,
            'question' => $question
        ]);
    }

    public function update(Request $request, Course $course, Test $test, Question $question)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
        ]);

        $question->update($attributes);

        return back()->with('success', __('Question updated successfully'));

    }

    public function delete(Course $course, Test $test, Question $question)
    {
        $test->questions()->detach($question);
        $question->delete();

        return back()->with('success', __('Question deleted successfully'));
    }
}
