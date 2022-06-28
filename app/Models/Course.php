<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'level_id',
        'certificate',
        'user_id',
        'slug',
    ];

    //attributes
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    //relationships
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

    //Scopes
    public function scopeFilter($query, array $filter) {
        $query->when($filter['search'] ?? false, function ($query, $search) {
                return $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
        });
    }
}
