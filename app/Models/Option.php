<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'question_option';

    protected $fillable = [
        'question_id',
        'name',
        'sort_order',
        'is_answer',
        'file_id',
    ];

    public function question()
    {
        $this->belongsTo(Question::class);
    }
}
