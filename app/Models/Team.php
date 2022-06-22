<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'user_id'];
    
    //Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'teams', 'user_id', 'team_id')
            ->withTimestamps();
    }

    //Attributes
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    //Scope
    public function scopeVisibleTo($query) {
        return $query->where('created_by', Role::ADMIN)
                    ->where('role_id', Role::EMPLOYEE)
                    ->where('status', User::ACTIVE);
    }
}
