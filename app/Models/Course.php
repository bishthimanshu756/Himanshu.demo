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
    public function enrollUsers() {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
                ->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

    public function image() {
        return $this->hasOne(Image::class);
    }

    //Scopes
    public function scopeFilter($query, array $filter) {
        $query->when($filter['search'] ?? false, function ($query, $search) {
                return $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
        });

        $query->when($filter['category']?? false, function ($query, $category) {
                return $query->where('category_id', $category);
        });

        $query->when($filter['level']?? false, function($query, $level) {
                return $query->where('level_id', $level);
        });

        $query->when($filter['orderBy']?? false, function($query, $orderBy) {
                if ($orderBy == 'a-z') {
                    return $query->orderBy('title', 'asc');
                } elseif ($orderBy == 'z-a') {
                    return $query->orderBy('title', 'desc');
                } elseif ($orderBy == 'desc') {
                    return $query->orderBy('created_at', 'desc');
                } else {
                    return $query->orderBy('created_at', 'asc');
                }
        });
    }
}
