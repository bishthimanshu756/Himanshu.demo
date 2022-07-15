<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->enrollments()->published()->filter(request(['search', 'orderBy']))->paginate();

        return view('learners.courses.index', [
            'courses' => $courses,
        ]);
    }

    public function show(Course $course)
    {
        return view('learners.courses.show', [
            'course' => $course,
        ]);
    }
}
