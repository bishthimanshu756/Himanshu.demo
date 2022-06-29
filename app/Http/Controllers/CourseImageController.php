<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class CourseImageController extends Controller
{
    public function index(Image $image) {
        dd(request()->all());
        dd($image);
    }
}
