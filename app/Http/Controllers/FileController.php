<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\File;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('files.create', [
            'course' => $course,
            'unit' => $unit
        ]);
    }

    public function store(Request $request, Course $course, Unit $unit)
    {
        $request->validate([
            'display_name' => ['required', 'min:4', 'max:20'],
            'duration' => ['required', 'min:0', 'numeric'],
            'file' => ['required', 'mimes:pdf','min:10']
        ]);

        if($request->file('file')->getClientOriginalExtension() == 'pdf') {
            $content_type = File::PDF;
            $path = $request->file->storeAs('public/documents', $request->display_name);
        };

        $file = File::create([
            'display_name' => $request->display_name,
            'file_size'  => $request->file->getsize(),
            'content_type' => $content_type,
            'duration' => $request->duration,
            'storage_url' => $path
        ]);

        $lesson = Lesson::make([
            'name' => $file->display_name,
            'unit_id' => $unit->id,
            'duration' => $file->duration,
        ]);

        $lesson->lessonable()->associate($file);

        $lesson->save();

        $unit->increment('lesson_count');
        $unit->duration->increment('duration', $lesson->duration);
        $unit->save();
        return redirect()->route('courses.units.edit', [$course, $unit])->with('success', 'Pdf Uploaded Successfully.');
    }

    public function edit(Course $course, File $file)
    {
        $this->authorize('edit', $course);
        return view('files.edit', [
            'course' => $course,
            'lesson' =>$file->lesson->load('unit'),
            'file' => $file,
        ]);
    }

    public function update(Course $course, File $file, Request $request)
    {
        $this->authorize('update', $course);
        
        $request->validate([
            'display_name' => ['required', 'min:3', 'max:20'],
            'duration' => ['required', 'numeric', 'min:0']
        ]);

        $file->update([
            'display_name' => $request->display_name,
            'duration' => $request->duration,
        ]);

        $lesson = $file->lesson->load('unit');
        $lesson->name = $file->display_name;
        $lesson->duration = $file->duration;
        $lesson->save();

        $lesson->unit->duration = $lesson->unit->lessons->sum('duration');
        $lesson->unit->save();


        return redirect()->route('courses.files.edit', [$course, $file])
            ->with('success', 'File updated successfully.');
    }

}
