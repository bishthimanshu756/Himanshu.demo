<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserTeamController extends Controller
{
    public function index(User $user) {
        $this->authorize('view', $user);

        $trainers = User::createdbyadmin()->active()->trainer()
            ->whereDoesntHave('assignedUsers', function($query) use($user) {
                $query->where('user_id', $user->id);
            })->get();


        return view('users.team_assigned', [
            'user' => $user,
            'trainers' => $trainers,
            'assignedtrainers' => $user->trainers()->get(),
        ]);
    }

    public function store(User $user, Request $request) {
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

        if($validator->fails()) {
            return back()->with('error', 'Please select at least one trainer.');
        }
        
        $validated = $validator->validated();
        $assignees = User::visibleTo(Auth::user())->findMany($validated['trainerIds']);
        $user->trainers()->attach($assignees);

        return back()->with('success', 'Trainer assign successfully!');
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

        if($validator->fails()) {
            return back()->with('error', 'Please select valid trainer.');
        }

        $validated = $validator->validated();

        $user->trainers()->detach($validated['trainerId']);

        return back()->with('success', 'Trainers unassign successfully!');
    }


}
