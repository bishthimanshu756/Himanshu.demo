<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        'status_id',
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

    public function getIsPublishedAttribute()
    {
        return $this->attributes['status_id'] == Status::PUBLISHED;
    }


    //relationships
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function enrolledUsers() {
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

    public function units() {
        return $this->belongsToMany(Unit::class, 'course_unit', 'course_id', 'unit_id')
            ->withTimestamps();
    }

    public function assignedTrainers()
    {
        return $this->belongsToMany(User::class, 'team_course', 'course_id', 'team_id')
            ->withTimestamps();
    }

    public function assignedCourses()
    {
        return $this->belongsToMany(User::class, 'team_course', 'course_id', 'team_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function enrollments(){
        return $this->belongsToMany(User::class)
            ->withPivot('completed_percentage', 'status')
            ->using(CourseUser::class);
    }

    //Scopes

    public function scopeCompletedPercentage($query, $course) {
        return $query->whereHas('enrollments', function ($query) use($course) {
            return $query->where('course_user.user_id', Auth::id())
                ->where('course_user.course_id', $course->id);
        })->get();
    }

    public function scopeCourseOwner($query) {
        return $query->where('user_id', Auth::id());
    }

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

    public function scopeVisibleTo($query)
    {
        if(Auth::user()->role_id == Role::ADMIN) {
            $query->where('user_id', Auth::id());
        }
        elseif(Auth::user()->role_id == Role::TRAINER){
            $query->where('user_id', Auth::id())
                ->orWherehas('assignedTrainers', function($query) {
                return $query->where('team_id', Auth::id());
            });
        } elseif(Auth::user()->role_id == Role::EMPLOYEE){
            $query->wherehas('enrolledCourses', function($query) {
                return $query->where('user_id', Auth::id());
            });
        }
    }

    public function scopePublished($query)
    {
        return $query->where('status_id', Status::PUBLISHED);
    }
}
