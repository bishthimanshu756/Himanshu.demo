<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamUserController extends Controller
{
    public function index(User $trainer)
    {
        $this->authorize('view', $trainer);

        $employees = User::createdbyadmin()->active()->employee()
            ->whereDoesnthave('trainers', function ($query) use ($trainer) {
                $query->where('team_id', $trainer->id);
            })->get();

        return view('users._users_trainer', [
            'user' => $trainer,
            'employees' => $employees,
            'assingedUsers' => $trainer->assignedUsers()->get(),

        ]);
    }

    public function store(Request $request, User $trainer)
    {
        $this->authorize('edit', $trainer);

        $validator = Validator::make($request->all(), [
            'userIds' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please select at least one employee.');
        }

        $validated = $validator->validated();

        $assignees = User::visibleTo(Auth::user())->findMany($validated['userIds']);

        $trainer->assignedUsers()->attach($assignees);

        return back()->with('success', 'Employee assign successfully!');
    }

    public function destroy(Request $request, User $trainer)
    {
        $this->authorize('delete', $trainer);

        $validator = Validator::make($request->all(), [
            'userId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', Role::EMPLOYEE);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please select valid employee.');
        }

        $validated = $validator->validated();

        $trainer->assignedUsers()->detach($validated['userId']);

        return back()->with('success', 'Employee unassign successfully!');
    }
}
