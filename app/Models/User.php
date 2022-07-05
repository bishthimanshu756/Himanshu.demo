<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $guarded=[];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'created_by',
        'status',
        'email_status'
    ];

    const INACTIVE = 0;
    const ACTIVE = 1;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'full_name'
            ]
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Attributes
    public function setPasswordAttribute($password){
        $this->attributes['password']= Hash::make($password);
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Relationships
    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function trainers() {
        return $this->belongsToMany(User::class, 'teams', 'user_id' , 'team_id')
            ->withTimestamps();
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'teams', 'team_id', 'user_id')
            ->withTimestamps();
    }

    public function courses() {
        return $this->belongsToMany(User::class, 'course_user', 'user_id', 'course_id');
    }

    public function courseAssign()
    {
        return $this->belongsToMany(User::class, 'team_course', 'team_id', 'course_id')
            ->withTimestamps();
    }


    // Scopes
    public function scopeVisibleTo($query) {
        return $query->Where('role_id', '>', Auth::user()->role_id)
                ->Where('created_by', Auth::id());
    }

    public function scopeOwner($query) {
        $query->where('created_by', Auth::id());
    }

    public function scopeTrainer($query) {
        $query->where('role_id', Role::TRAINER);
    }

    public function scopeEmployee($query) {
       $query->where('role_id', Role::EMPLOYEE);
    }

    public function scopeEnrolledUsers($query) {
        $query->where('role_id', '>=', Role::TRAINER);
    }

    public function scopeActive($query) {
        $query->where('status', User::ACTIVE);
    }

    public function scopeFilter($query, array $filter) {

        $query->when($filter['roleId'] ?? false, function($query, $roleId) {
            return $query->where('role_id', $roleId);
        });

        $query->when($filter['orderBy'] ?? false, function($query, $orderBy) {
                if($orderBy == 'a-z') {

                    return $query->orderBy('first_name', 'asc');
                } elseif ($orderBy == 'z-a') {

                    return $query->orderBy('first_name', 'desc');
                } else {

                    return $query->orderBy('created_at', $orderBy);
                }
        });

        $query->when($filter['search'] ?? false, function($query, $search) {
            return $query->where('first_name', 'like', '%' .$search. '%')
                        ->orWhere('last_name', 'like', '%' . $search. '%')
                        ->orWhere('email', 'like', '%'.$search. '%');
        });
    }

}
