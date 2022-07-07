<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class PasswordResetController extends Controller
{
    public function showResetForm(User $user)
    {
        return view('mails.reset',[
            'user' => $user,
        ]);
    }

    public function resetPassword(User $user, Request $request)
    {
        $request->validate([
            'password' => ['required', Password::defaults()],
            'confirm_password' => ['required', 'same:password', Password::defaults()]
        ]);

        $user->update([
            'password' => $request->password,
        ]);

        return redirect()->route('users.index')
            ->with('success', __('Password reset successfully.'));
    }
}
