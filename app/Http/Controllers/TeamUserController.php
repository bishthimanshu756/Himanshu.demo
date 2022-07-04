<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\TeamUserEmployeeAssignNotification;
use App\Notifications\TeamUserEmployeeUnassignNotification;
use App\Notifications\TeamUserTeamAssignNotification;
use App\Notifications\TeamUserTeamUnassignNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamUserController extends Controller
{
    public function index(User $trainer)
    {
        $this->authorize('view', $trainer);

        $employees = User::owner()->active()->employee()
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

        //Validation for Employees already assigned to Trainer in teams table
        $teamExists = Team::where('user_id', $validated['userIds'])
                    ->where('team_id', $trainer->id)->get();

        if ($teamExists->isNotEmpty()) {
            return back()->with('error', 'Employee already assigned to Trainer.');
        }

        $assignees = User::visibleTo(Auth::user())->findMany($validated['userIds']);

        $trainer->assignedUsers()->attach($assignees);

        Notification::send($trainer, new TeamUserEmployeeAssignNotification(Auth::user(), $assignees));
        Notification::send($assignees, new TeamUserTeamAssignNotification(Auth::user(), $trainer));

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

        $employee = User::visibleTo()->find($validated['userId']);

        $trainer->assignedUsers()->detach($validated['userId']);

        Notification::send($trainer, new TeamUserEmployeeUnassignNotification(Auth::user(), $employee));
        Notification::send($employee, new TeamUserTeamUnassignNotification(Auth::user(), $trainer));

        return back()->with('success', 'Employee unassign successfully!');
    }
}
