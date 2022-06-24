<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function(User $user) {
            return in_array($user->role_id, [1] );
        });

        Gate::define('sub_admin', function(User $user) {
            return in_array($user->role_id, [1,2]);
        });

        Gate::define('trainer', function(User $user) {
            return in_array($user->role_id, [1,2,3]);
        });

        Gate::define('is_trainer', function(User $user) {
            return $user->role_id == Role::TRAINER;
        });

        Gate::define('is_employee', function(User $user) {
            return $user->role_id == Role::EMPLOYEE;
        });

    }
}
