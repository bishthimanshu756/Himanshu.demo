<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function delete(Course $course, Lesson $lesson)
    {
        $this->authorize('delete', $course);

        /**Unit Duration Update */
        $lesson->unit->decrement('duration', $lesson->duration);

        $lesson->delete();
        $lesson->unit->decrement('lesson_count');

        return back()->with('success', __('Tests successfully deleted.'));
    }
}
