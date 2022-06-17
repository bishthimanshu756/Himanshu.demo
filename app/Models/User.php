<?php

namespace App\Models;
use App\Models\Role;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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

    // Password attributes
    public function setPasswordAttribute($password){
        $this->attributes['password']= bcrypt($password);
    }
    
    // Full name attributes
    public function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }


    public function scopeAdmin() 
    {
        return $this->role_id = 1;
    }

    public function scopeUserVisibleTo($query)
    {   
        if(Auth::id()== Role::ADMIN)
        {
            return $query->Where('role_id', '>', Auth::user()->role_id);
        }

        return $query->Where('role_id', '>', Auth::user()->role_id)
        ->Where('created_by', Auth::id());
    }

    public function scopeUserListing($query){
        return $query->where('id', '>', Auth::id());
    }

}
