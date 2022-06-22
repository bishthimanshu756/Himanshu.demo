<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{
    public function index(User $user)
    {
        $employees = User::CreatedByAdmin()->Active()->Employee()->get();

        return view('users.users_trainer', [
            'user' => $user,
            'employees' => $employees,
            
        ]);
    }

    public function store(Request $request, User $user) {
        
        $user->teams()->attach($request->checked);

        return back();
    }

    public function destroy(Request $request, User $trainer) {

        $trainer->teams()->attach($request->checked);

        return back();
    }
}
