<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamCourse extends Pivot
{
    use HasFactory;

    protected $table = 'team_course';

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
