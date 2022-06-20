<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

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
        return $query->where('user_id', '=' ,Auth::id())->get();
    }
}
