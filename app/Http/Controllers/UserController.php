<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request, User $user) {

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

        $user = User::where('email', $request->email)->withTrashed()->first();
        if ($user) {
            if (!$user->deleted_at) {
                return back()->with('error', __('Email already exists'));
            } else {
                $user->restore();
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_id' => $request->role_id,
                ]);
                return back()->with('success', __('User updated successfully.'));
            }
        }

        //create a user 
        $attributes = request()->validate([
            'first_name' => ['required', 'max:255', 'min:3'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Password::defaults()],
            'role_id' => 'required|in:' . $ids,
        ]);

        // we need to store auth id into created_by column when user created.

        $attributes += ['created_by' => Auth::id()];

        $user = User::create($attributes);
        // Notification::send($user, new WelcomeNotification(Auth::user()));

        switch ($request->action){
            case 'create':
                return redirect()->route('users.index')
                    ->with('success', 'User created successfully');
                    break;
            case 'create_another': 
                return back()->with('success', __('User added successfully.'));
        }

    }

    public function edit(User $user) {
       
        $this->authorize('edit', $user);

        return view('users.edit', [
            'roles' => Role::get(),
            'user' => $user,
        ]);
    }

    public function update(User $user, Request $request) {
        
        $this->authorize('update', $user);
        $attributes = request()->validate([
            'first_name' => ['required', 'max:255', 'min:3', 'string'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:255'],
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
    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', __('User deleted successfully'));
    }
    
}
