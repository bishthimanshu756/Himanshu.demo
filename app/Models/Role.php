<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;

    // protected $guarded=[];
    protected $fillable=[
        'name',
        'slug',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
