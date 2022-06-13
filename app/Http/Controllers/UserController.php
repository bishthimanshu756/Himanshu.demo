<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(){
        //listing
        return view( 'users.index',[ 'users'=>User::get() ]);
    }

    public function create(){
        //redirectig to add page
        return view( 'users.create' );
    }

    public function store(){

        //adding User
        $attributes = request()->validate([
            'name' => ['required','max:255', 'min:5', 'string'],
            'email' => ['required','email','max:255', 'unique:users,email'],
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'number' => ['required','integer','min:10', 'unique:users,number'],
            'city' => ['required','min:4','max:255']
        ]);
        
        User::create($attributes);

        return back()->with( 'success','User added successfully.' );
    }

    public function edit($user){
        //redirecting to edit page

        return view('users.edit', [ 'user'=> User::find($user) ]);
    }

    public function update(User $user){
        //update the user data and 

        $attributes= request()->validate([
            'name'=> ['required','max:255', 'min:5', 'string'],
            'email'=> ['required','email','max:255'],
            'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'number'=> ['required','integer','digits:10'],
            'city'=> ['required','min:4','max:50']
        ]);
        $user->update($attributes);

        return redirect()->route("users.index")->with('success','User updated successfully');

    }

    public function delete(User $user){
        //deleting the data and redirecting to index page
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

}
