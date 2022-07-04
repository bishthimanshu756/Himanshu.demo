<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamCourseController extends Controller
{
    public function index(Course $course)
    {
        $this->authorize('view', $course);
        $user = User::owner()->active()->trainer()->
            whereDoesntHave('courseAssign', function($query) use($course) {
                return $query->where('course_id', $course->id);
            })->get();

        return view('courses._team_assign', [
            'course' => $course,
            'users' => $user,
            'assignedUsers' => $course->assignedTrainers()->get(),
        ]);
    }

    public function store(Course $course, Request $request)
    {
        $this->authorize('store', $course);
        $validator = Validator::make($request->all(), [
            'userIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please select at least one Trainer');
        };
        $validated = $validator->validated();

        $trainers = User::visibleTo()->findMany($validated['userIds']);

        if ($trainers->count() == 0) {
            return back()->with('error', 'Please select at least one valid Trainer.');
        }

        $course->assignedTrainers()->attach($trainers);

        return back()->with('success', 'Trainers assigned successfully.');
    }

    public function delete(Request $request, Course $course)
    {
        $this->authorize('delete', $course);
        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                Rule::exists('users', 'id')->where(function($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if($validator->fails()) {
            return back()-> with('error', 'Please select valid Trainer.');
        }

        $validated = $validator->validated();

        $trainer = User::visibleTo()->find($validated['userId']);

        $course->assignedTrainers()->detach($trainer);

        return back()->with('success', 'Trainer unassigned successfully.');
    }
}
