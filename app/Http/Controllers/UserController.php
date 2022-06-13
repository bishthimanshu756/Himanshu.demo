<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(User $user){
        return view('user.index',[
            'users'=>$user->get()
        ]);
    }

    public function add(){
        return view('user.add');
    }

    public function store(){
        $attributes = request()->validate([
            'name'=>['required','max:255', 'min:5', 'string'],
            'email'=>['required','email','max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'number'=>['required','integer','digits:10', 'unique:users,number'],
            'city'=>['required','min:4','max:50']
        ]);
        
        User::create($attributes);

        session()->flash('success','User added successfully.');

        return redirect('/users');
    }

    public function edit(User $user){
        return view('user.edit', [
            'user'=> $user
        ]);
    }

    public function update(User $user){

        $attributes= request()->validate([
            'name'=> ['required','max:255', 'min:5', 'string'],
            'email'=> ['required','email','max:255'],
            'number'=> ['required','integer','digits:10'],
            'city'=> ['required','min:4','max:50']
        ]);
        $user->update($attributes);

        return redirect('/users')->with('success','User updated successfully');

    }

    public function delete(User $user){
        $user->delete();
        return redirect('/users')->with('success','User deleted successfully');
    }

}
