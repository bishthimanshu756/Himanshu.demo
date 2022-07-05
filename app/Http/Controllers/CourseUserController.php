<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Notifications\CourseUserEnrollNotification;
use App\Notifications\CourseUserUnenrollNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseUserController extends Controller
{
    public function index(Course $course)
    {
        $this->authorize('view', $course);

        $users = User::owner()->active()->user()
            ->whereDoesnthave('courses', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })->get();


        return view('courses._users_enroll', [
            'users' => $users,
            'course' => $course,
        ]);
    }

    public function store(Course $course, Request $request)
    {
        $this->authorize('store', $course);

        $validator = Validator::make($request->all(), [
            'usersIds' => [
                'required',
                'min:1',
                Rule::exists('users','id')->where(function($query) {
                    return $query->where('role_id','>',Role::SUB_ADMIN);
                })
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please select at least one user.');
        }

        $validated = $validator->validated();

        $users = User::visibleTo()->findMany($validated['usersIds']);

        $course->enrollUsers()->attach($users, [
            'assigned_by' => Auth::id(),
            'status' => Status::DRAFT,
        ]);

        Notification::send($users, new CourseUserEnrollNotification(Auth::user(), $course));

        return back()->with('success', 'User enrolled successfully.');
    }

    public function delete(Course $course, Request $request )
    {
        $this->authorize('delete', $course);

        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                Rule::exists('users', 'id')->where(function($query) {
                    return $query->where('role_id', '>', Role::SUB_ADMIN);
                })
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please select valid user.');
        }

        $validated = $validator->validated();

        $user = User::visibleTo()->find($validated['userId']);

        $course->enrollUsers()->detach(request()->userId);

        Notification::send($user, new CourseUserUnenrollNotification(Auth::user(), $course));

        return back()->with('success', 'User unenrolled successfully.');
    }
}