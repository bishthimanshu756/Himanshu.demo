<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserStatusController extends Controller
{
    /**
     * Change the Status of the User.
     */
    public function update(User $user)
    {
        if ($user->status == User::INACTIVE)
        {
            $attribute['status'] = User::ACTIVE;
        }
        else
        {
            $attribute['status'] = User::INACTIVE;
        }

        $user->update($attribute);

        return back()->with('success', 'User updated successfully');
    }
}
