<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    const PUBLISHED = 1;
    const DRAFT = 2;
    const ARCHIVED = 3;

    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
