<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
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
        $this->authorize('show', $course);

        return view('learners.courses.show', [
            'course' => $course,
        ]);
    }

    public function test(Course $course)
    {
        $units = $course->units->load('lessons');
        dd($units[0]->lessons);
        return view('learners.tests.show_pdf', [
            'course' => $course,
            // 'test' => $test,
        ]);
    }
}
