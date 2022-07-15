<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $fillable = [
        'course_id',
        'image_path',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
