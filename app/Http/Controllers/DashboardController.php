<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function view()
    {
        return view('dashboard', [
            'user' =>Auth::user(),
            'users' => User::where('created_by', Auth::id()),
            'categories' => Category::where('user_id', Auth::id())
        ]);
    }
}
