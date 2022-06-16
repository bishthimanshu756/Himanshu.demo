<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function update(User $user) {
        if($user->status == 0){
            $attribute['status'] = 1;
        }
        else{
            $attribute['status'] = 0;
        }

        $user->update($attribute);
        
        return back()->with('success', 'User updated successfully');
    }
}
