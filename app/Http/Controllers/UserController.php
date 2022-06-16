<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {
        //listing
        $users= User::UserVisible()->get();

        //to listing with trashed users
        // $users= User::UserVisible()->get();
        
        return view('users.index', compact('users'));
    }

    public function create() {
        //redirectig to add page
        $roles= Role::get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request) {

        if(Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        }
        elseif(Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        }
        else
        {
            $ids = '2,3,4';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();

        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')->with('error', __('Role does not exists'));
        }

        //adding User
        $attributes = request()->validate([
            'first_name' => ['required','max:255', 'min:3', 'string'],
            'last_name' => ['string'],
            'email' => ['required','email','max:255', 'unique:users,email'],
            'password' => ['required',Password::defaults()],
            'role_id' => 'required | in:'.$ids,
        ]
    );
        
    // we need to store auth id into created_by column when user created.
    
        $attributes += [
            'created_by' => Auth::id(),
        ];
        User::create($attributes);

        return back()->with( 'success', __('User added successfully.') );
    }

    public function edit(User $user){
        //redirecting to edit page
        $roles = Role::get();
        return view('users.edit', compact('user','roles'));
    }

    public function update(User $user, Request $request){
        //update the user data
        
        if(Auth::user()->role_id == Role::TRAINER) {
            $ids = '4';
        }
        elseif(Auth::user()->role_id == Role::SUB_ADMIN) {
            $ids = '3,4';
        }
        else
        {
            $ids = '2,3,4';
        }

        $roles = Role::where('slug', '!=', 'admin')->pluck('id')->toArray();

        if (!in_array($request->role_id, $roles)) {
            return redirect()->route('users.index')->with('error', __('Role does not exists'));
        }
        
        $attributes= request()->validate([
            'first_name' => ['required','max:255', 'min:3', 'string'],
            'last_name'=> ['string'],
            'email'=> ['required','email','max:255'],
            'password' => ['required', Password::defaults()],
        ]);
        
        $attributes+=[
            'role_id' => $request->role_id,
        ];

        $user->update($attributes);

        return redirect()->route('users.index')->with('success', __('User updated successfully'));

    }


    public function delete(User $user){
        //deleting the data and redirecting to index page
        $user->delete();
        return redirect()->route('users.index')->with('success', __('User deleted successfully') );
    }

}
