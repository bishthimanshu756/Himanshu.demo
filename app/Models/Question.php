<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'name'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function questions()
    {
        return $this->belongsToMany(Test::class, 'test_question', 'question_id', 'test_id');
    }

    public function options()
    {
        return $this->belongsToMany(Question::class, 'question_option', 'question_id');
    }
}
