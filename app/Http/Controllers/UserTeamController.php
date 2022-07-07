<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\UserTeamEmployeeAssignNotification;
use App\Notifications\UserTeamEmployeeUnassignNotification;
use App\Notifications\UserTeamTeamAssignNotification;
use App\Notifications\UserTeamTeamUnassignNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserTeamController extends Controller
{
    /**
     * Multiple Trainers are assigned to a single User.
     */
    public function index(User $user)
    {
        $this->authorize('view', $user);

        $trainers = User::owner()->active()->trainer()
            ->whereDoesntHave('assignedUsers', function($query) use($user) {
                $query->where('user_id', $user->id);
            })->get();

        return view('users._team_assigned', [
            'user' => $user,
            'trainers' => $trainers,
            'assignedtrainers' => $user->trainers()->get(),
        ]);
    }

    public function store(User $user, Request $request)
    {
        $this->authorize('edit', $user);

        $validator= Validator::make($request->all(), [
            'trainerIds' => [
                'required',
                'min:1',
                Rule::exists('users','id')->where(function($query) {
                    return $query->where('role_id', Role::TRAINER);
                }),
            ],
        ]);

        if($validator->fails())
        {
            return back()->with('error', 'Please select at least one trainer.');
        }

        $validated = $validator->validated();

        //Validation for Trainers already assigned to Employee in team table
        $teamExists = Team::where('team_id',$validated['trainerIds'])
                ->where('user_id', $user->id)->get();


        if($teamExists->isNotEmpty())
        {
            return back()->with('error', __('Trainer already assigned to the employee.'));
        }

        $assignees = User::visibleTo(Auth::user())->findMany($validated['trainerIds']);

        $user->trainers()->attach($assignees);

        Notification::send($assignees, new UserTeamEmployeeAssignNotification(Auth::user(), $user));
        Notification::send($user, new UserTeamTeamAssignNotification(Auth::user(), $assignees));

        return back()->with('success', __('Trainer assign successfully!'));
    }

    public function destroy(User $user, Request $request) {
        $this->authorize('delete', $user);

        $validator = Validator::make($request->all(), [
            'trainerId' => [
                'required',
                'min:1',
                Rule::exists('users', 'id')->where(function($query) {
                    return $query->where('role_id', Role::TRAINER);
                })
            ],
        ]);

        if ($validator->fails()) {
            return back()->with('error', __('Please select valid trainer.'));
        }

        $validated = $validator->validated();

        $assignee = User::visibleTo()->find($validated['trainerId']);

        $user->trainers()->detach($validated['trainerId']);

        Notification::send($user, new UserTeamTeamUnassignNotification(Auth::user(), $assignee));
        Notification::send($assignee, new UserTeamEmployeeUnassignNotification(Auth::user(), $user));

        return back()->with('success', __('Trainers unassign successfully!'));
    }


}
