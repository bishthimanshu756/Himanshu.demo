<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index (Course $course, Unit $unit)
    {
        return view('courses.units.tests.index', [
            'course' => $course,
            'unit' => $unit,
        ]);
    }

    public function create(Course $course, Unit $unit)
    {
        return view('courses.units.tests.create', [
            'course' => $course,
            'unit' => $unit
        ]);
    }
}
