<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $fillable=[
        'user_id',
        'name',
        'slug',
        'status'
    ];

    //relationship
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function scopeVisibleTo($query) {
        if(Auth::user()->role_id == Role::ADMIN) {
            return $query->where('user_id', Auth::id());
        } elseif(Auth::user()->role_id == Role::TRAINER) {
            return $query->where('user_id', Auth::id())
                ->orWhere('user_id', Auth::user()->created_by);
        }
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeFilter($query, array $filter) {
        $query->when($filter['search']??false, function($query, $search) {
            $query->where('name', 'like', '%'. "$search".'%');
        });

        $query->when($filter['orderBy']??false, function($query, $orderBy){
            if($orderBy == 'a-z') {
                return $query->orderby('name', 'asc');
            } elseif ($orderBy == 'z-a') {
                return $query->orderby('name', 'desc');
            } elseif($orderBy == 'desc') {
                return $query->orderby('created_at', 'desc');
            } else {
                return $query->orderby('created_at', 'asc');
            }
        });
    }
}
