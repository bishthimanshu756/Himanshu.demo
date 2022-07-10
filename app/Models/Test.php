<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'pass_percentage',
        'total_questions',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_question', 'test_id', 'question_id')
            ->withTimestamps();
    }
}
