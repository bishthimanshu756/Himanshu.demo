<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class QuestionController extends Controller
{
    public function create(Course $course, Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
        ]);
    }

    public function store(Request $request, Course $course, Test $test)
    {
        $request->validate([
            'name' => ['required','min:3','max:255',],
            'answer' => ['required','min:1','regex:/[1-4]/'],
            'options.*' => ['required'],
        ]);

        $question = Question::create([
            'name' => $request->name,
        ]);

        $test->questions()->attach($question);

        $collection = new Collection($request->options);

        $collection->each(function($value, $key) use($question, $request){
            $option = Option::make([
                'question_id' => $question->id,
                'name' => $value,
                'is_answer' => $request->answer == $key ? '1':'0',
            ]);
            $option->save();
        });

        if($request->action == 'save'){
            return redirect()->route('courses.tests.questions.edit', [$course, $test, $question])
                ->with('success', __('Question created successfully.'));
        }

        return back()->with('success', __('Question created successfully.'));

    }

    public function edit(Course $course, Test $test, Question $question)
    {
        return view('questions.edit', [
            'course' => $course,
            'lesson' => $test->lesson->load('unit'),
            'test' => $test,
            'question' => $question,
            'options' => Option::where('question_id', $question->id)->get()
        ]);

    }

    public function update(Request $request, Course $course, Test $test, Question $question)
    {
        $request->validate([
            'name' => ['required','min:3','max:255',],
            'answer' => ['required','min:1','regex:/[1-4]/'],
            'options.*' => ['required'],
        ]);

        $question->update([
            'name' => $request->name
        ]);

        $question->options->each(function($option, $key) use($request) {
            $option->name = $request->options[$key];
            $option->is_answer = $request->answer == $option->id? '1':'0';
            $option->save();
        });

        return redirect()->route('courses.tests.edit', [$course, $test])
            ->with('success', __('Question updated successfully'));
    }

    public function delete(Course $course, Test $test, Question $question)
    {

        $test->questions()->detach($question);

        $question->options()->delete();

        $question->delete();

        return back()->with('success', __('Question deleted successfully'));
    }
}
