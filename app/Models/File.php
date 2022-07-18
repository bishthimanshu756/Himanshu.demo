<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    const PDF = 'PDF';

    protected $fillable = [
        'display_name',
        'file_size',
        'content_type',
        'duration',
        'disk',
        'storage_url',
    ];

    public function lesson()
    {
        return $this->morphOne(Lesson::class, 'lessonable');
    }
}
