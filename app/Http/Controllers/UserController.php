<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\Role;
use App\Models\User;
use App\Notifications\MyWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {

        return view('users.index', [
            'users' => User::UserVisibleTo()->get(),
        ]);
    }

    public function create() {

        return view('users.create', [
            'roles' => Role::get(),
        ]);
    }

    public function store(Request $request) {

        if(Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        }
        elseif(Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        }
        else {
            $ids = '2,3,4';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();

        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')
                ->with('error', __('Role does not exists'));
        }

        //create a user 
        $attributes = request()->validate([
            'first_name' => ['required','max:255', 'min:3', 'string'],
            'last_name' => ['string'],
            'email' => ['required','email','max:255', 'unique:users,email'],
            'password' => ['required',Password::defaults()],
            'role_id' => 'required|in:'.$ids,
        ]);
    
        // we need to store auth id into created_by column when user created.
    
        $attributes += [
            'created_by' => Auth::id(),
        ];

       $user = User::create($attributes);

        return back()->with('success', __('User added successfully.'));
    }

    public function edit(User $user){
        return view('users.edit', [
            'roles' => Role::get(),
            'user' => $user,
        ]);
    }

    public function update(User $user, Request $request) {
        if (Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        } elseif (Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        } else {
            $ids = '2,3,4';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();

        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')
                ->with('error', __('Role does not exists'));
        }
        
        $attributes= request()->validate([
            'first_name' => ['required','max:255', 'min:3', 'string'],
            'last_name'=> ['string'],
            'email'=> ['required','email','max:255'],
            'password' => ['required', Password::defaults()],
        ]);
        
        $attributes += [
            'role_id' => $request->role_id,
        ];

        $user->update($attributes);

        return redirect()->route('users.index')
            ->with('success', __('User updated successfully'));
    }

    //* Delete a user //
    public function delete(User $user) {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', __('User deleted successfully') );
    }
}
