<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Unit;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function delete(Course $course, Unit $unit, Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', __('Tests successfully deleted.'));
    }
}
