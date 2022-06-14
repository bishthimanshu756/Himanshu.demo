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
    public function index(){
        //listing
        $users = User::where('id', '!=', Auth::id())->get();
        return view( 'users.index', compact('users'));
    }

    public function create(){
        //redirectig to add page
        $roles= Role::get();
        return view('users.create', compact('roles'));
    }

    public function store(){

        //adding User
        $attributes = request()->validate([
            'first_name' => ['required','max:255', 'min:5', 'string'],
            'last_name' => ['required','max:255', 'min:5', 'string'],
            'email' => ['required','email','max:255', 'unique:users,email'],
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'number' => ['required','integer','min:10', 'unique:users,number'],
            'city' => ['required','min:4','max:255'],
            'role_id' => ['required'],
        ]);
        
        User::create($attributes);

        return back()->with( 'success','User added successfully.' );
    }

    public function edit(User $user){
        //redirecting to edit page
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(User $user){
        //update the user data and 

        $attributes= request()->validate([
            'first_name' => ['required','max:255', 'min:5', 'string'],
            'last_name'=> ['required','max:255', 'min:5', 'string'],
            'email'=> ['required','email','max:255'],
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'number'=> ['required','integer','min:10'],
            'city'=> ['required','min:4','max:50'],
            'role_id' => ['required']
        ]);

        $user->update($attributes);

        return redirect()->route('users.index')->with('success', __('User updated successfully'));

    }

    public function delete(User $user){
        //deleting the data and redirecting to index page
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

}
