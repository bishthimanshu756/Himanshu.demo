<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
            'unit' => $test->lesson->unit,
            'test' => $test,
        ]);
    }

    public function store(Course $course, Test $test, Request $request)
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

        foreach($request->options as $key=>$option){
            Option::create([
                'question_id' => $question->id,
                'name' => $option,
                'is_answer' => $request->answer == $key ? '1':'0',
            ]);
        }

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
            'unit' => $test->lesson->unit,
            'test' => $test,
            'question' => $question,
            'options' => Option::where('question_id', $question->id)->get()
        ]);

    }

    public function update(Request $request, Course $course, Test $test, Question $question)
    {   /**For routes */
        $unit = $test->lesson->unit;

        $request->validate([
            'name' => ['required','min:3','max:255',],
            'answer' => ['required','min:1','regex:/[1-4]/'],
            'options.*' => ['required'],
        ]);

        $question->update([
            'name' => $request->name
        ]);

        /**Updating the options */
        $i=0;
        $options = $question->options;
        foreach ($options as $option)
        {
            $option->update([
                'name' => $request->options[$i],
                'is_answer' => $request->answer == $option->id ? '1': '0',
            ]);
            $i++;
        }

        return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])
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
