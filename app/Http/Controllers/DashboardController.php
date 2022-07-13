<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $this->authorize('viewAny', Auth::user());

        return view('dashboard', [
            'user' =>Auth::user(),
            'users' => User::where('created_by', Auth::id()),
            'categories' => Category::where('user_id', Auth::id())
        ]);
    }
}
