<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'unit_id',
        'lessonable_type',
        'lessonable_id',
        'sort_order',
        'duration',
        'skippable',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the parent lessonable model.
     */
    public function lessonable()
    {
        return $this->morphTo();
    }

    /**Relationships */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
