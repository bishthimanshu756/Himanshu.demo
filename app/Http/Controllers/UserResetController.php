<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Validation\Rules\Password;

class UserResetController extends Controller
{
    public function showResetForm(User $user) {
        return view('mails.reset',[
            'user' => $user, 
        ]);
    }

    public function resetPassword(User $user) {
        request()->validate([
            'password' => ['required', Password::defaults()],
            'confirm_password' => ['required', 'same:password', Password::defaults()]
        ]);

        $user->update([
            'password' => request()->password,
        ]);

        return redirect()->route('users.index');
        
    }
}
