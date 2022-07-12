<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'lesson_count',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /** Relationships */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_unit', 'unit_id', 'course_id')
            ->withPivot('sort_order')->withTimestamps();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
