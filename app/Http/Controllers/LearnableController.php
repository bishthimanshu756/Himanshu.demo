<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnableController extends Controller
{
    public function index()
    {
        return view('learnables.index');
    }
}
