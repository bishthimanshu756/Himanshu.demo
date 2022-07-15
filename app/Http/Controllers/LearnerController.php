<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller
{
    public function index()
    {
        $course = Auth::user()->enrollments()->published()->with(['units'])->paginate();

        return view('learners.courses.index', [
            'courses' => $course,
        ]);
    }

    public function show(Course $course)
    {
        return view('learners.courses.show', [
            'course' => $course,
        ]);
    }
}
