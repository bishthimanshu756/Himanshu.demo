<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionOptionsRequest;
use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Support\Collection;

class QuestionController extends Controller
{
    public function create(Course $course, Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'test' => $test,
        ]);
    }

    public function store(StoreQuestionOptionsRequest $request, Course $course, Test $test)
    {
        $request->validated();

        $question = Question::create([
            'name' => $request->name,
        ]);

        $test->questions()->attach($question);
        $test->increment('total_questions');

        $collection = new Collection($request->options);

        $collection->each(function($value, $key) use($question, $request) {
            $option = Option::make([
                'question_id' => $question->id,
                'name' => $value,
                'is_answer' => $request->answer == $key ? '1':'0',
            ]);
            $option->save();
        });

        if($request->action == 'save') {
            return redirect()->route('courses.tests.questions.edit', [$course, $test, $question])
                ->with('success', __('Question created successfully.'));
        }

        return back()->with('success', __('Question created successfully.'));

    }

    public function edit(Course $course, Test $test, Question $question)
    {
        $this->authorize('edit', $course);

        return view('questions.edit', [
            'course' => $course,
            'test' => $test,
            'question' => $question,
        ]);

    }

    public function update(StoreQuestionOptionsRequest $request, Course $course, Test $test, Question $question)
    {
        $this->authorize('update', $course);

        $request->validated();

        $question->update([
            'name' => $request->name
        ]);

        $question->options->each(function($option, $key) use($request) {
            $option->name = $request->options[$key];
            $option->is_answer = $request->is_answer == $key ? '1':'0';
            $option->save();
        });

        return back()->with('success', __('Question updated successfully'));
    }

    public function delete(Course $course, Test $test, Question $question)
    {
        $this->authorize('delete', $course);

        $test->decrement('total_questions');

        $test->questions()->detach($question);

        $question->options()->delete();

        $question->delete();

        return back()->with('success', __('Question deleted successfully'));
    }
}
