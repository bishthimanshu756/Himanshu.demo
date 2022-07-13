<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function index()
    {
        return view('learners.index', [
            'courses' => Course::VisibleTo()->paginate(),
        ]);
    }
}
