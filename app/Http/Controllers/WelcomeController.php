<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class WelcomeController extends Controller
{
    public function showWelcomeForm(User $user) {

        return view('mails.set-password', [
            'user'=> $user
        ]);
    }

    public function setPassword(Request $request, User $user) {
        $request->validate([
            'password' => ['required', Password::defaults()],
            'confirm_password' => ['required', 'same:password', Password::defaults()]
        ]);
        
        $user->update([
            'password' => $request->password,
        ]);

        return redirect()->route('login')
            ->with('success', 'Your password has been created successfully');
    }
}
