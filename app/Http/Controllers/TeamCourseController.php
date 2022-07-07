<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamCourseController extends Controller
{
    /**
     * Multiple Courses are assigned to a single Trainer to manage.
     */
    public function index(User $trainer)
    {
        $course = Course::visibleTo()
            ->whereDoesntHave('assignedCourses', function ($query) use($trainer) {
                return $query->where('team_id', $trainer->id);
            })->get();


        return view('users._course_assigned', [
            'user' => $trainer,
            'unassignedCourses' => $course,
            'assignedCourses' => $trainer->assignedCourses()->get(),
        ]);
    }

    public function store(User $trainer, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'courseIds' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        if ($validator->fails())
        {
            return back()->with('error', __('Please select at least one valid courses') );
        }

        $validated = $validator->validated();

        $courses = Course::courseOwner()->findMany($validated['courseIds']);

        $trainer->assignedCourses()->attach($courses);

        return back()->with('success', __('Course assigned successfully.') );
    }

    public function delete(Request $request, User $trainer)
    {
        $validator = Validator::make($request->all(), [
            'courseId' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        if($validator->fails())
        {
            return back()->with('error', __('Please select valid Course.') );
        }

        $validated = $validator->validated();

        $course = Course::courseOwner()->find($validated['courseId']);

        $trainer->assignedCourses()->detach($course);

        return back()->with('success', __('Course unassigned successfully.') );
    }
}
