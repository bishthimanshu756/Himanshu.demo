<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserStatusController extends Controller
{
    public function update(User $user) {
        if ($user->status == User::INACTIVE){
            $attribute['status'] = User::ACTIVE;
        }
        else {
            $attribute['status'] = User::INACTIVE;
        }

        $user->update($attribute);
        
        return back()->with('success', 'User updated successfully');
    }
}
