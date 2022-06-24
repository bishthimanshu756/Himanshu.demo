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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeVisibleTo($query) {
        return $query->where('user_id', '=' ,Auth::id());
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
