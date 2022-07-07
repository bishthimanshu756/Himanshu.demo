<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserEnrollmentController extends Controller
{
    /**
     * Multiple Courses are enrolled to a single Trainer/User.
     */
    public function index(User $user)
    {
        $this->authorize('view', $user);

        $course = Course::courseOwner()
            ->whereDoesntHave('enrolledCourses', function($query) use($user) {
                return $query->where('user_id', $user->id);
            })->get();

        return view('users._course_enrolled', [
            'user' => $user,
            'unenrolledCourses' => $course,
            'enrolledCourses' => $user->enrolledCourses()->get(),
        ]);
    }

    public function store(User $user, Request $request)
    {
        $this->authorize('edit', $user);

        $validator = Validator::make($request->all(), [
            'courseIds' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
        ]);

        if ($validator->fails())
        {
            return back()->with('error', __('Please select at least one course.'));
        }

        $validated = $validator->validated();

        $courses = Course::visibleTo()->findMany($validated['courseIds']);

        $user->enrolledCourses()->attach($courses);

        return back()->with('success', __('Course enrolled successfully.'));
    }

    public function delete(User $user, Request $request)
    {
        $this->authorize('delete', $user);

        $validator = Validator::make($request->all(), [
            'courseId' => [
                'required',
                'min:1',
                Rule::exists('courses', 'id')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        if ($validator->fails())
        {
            return back()->with('error', __('Please select valid Course.'));
        }

        $validated = $validator->validated();

        $course = Course::visibleTo()->find($validated['courseId']);

        $user->enrolledCourses()->detach($course);

        return back()->with('success', __('Course unenrolled successfully.'));
    }
}
