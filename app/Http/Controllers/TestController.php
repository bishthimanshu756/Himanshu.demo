<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('tests.create', [
            'course' => $course,
            'unit' => $unit
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
