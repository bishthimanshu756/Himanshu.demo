<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // protected $guarde    d=[];
    protected $fillable=['first_name', 'last_name', 'email', 'password', 'number', 'city', 'role_id'];

    public function user() {
        return $this->hasMany(User::class);
    }
}
