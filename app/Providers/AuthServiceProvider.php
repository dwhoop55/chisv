<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-conference', function ($user) {
            $adminRoleId = Role::where('name', 'admin')->first()->id;
            return $user->permissions->where('role_id', $adminRoleId)->isNotEmpty();
        });

        Gate::define('delete-conference', function ($user) {
            $adminRoleId = Role::where('name', 'admin')->first()->id;
            return $user->permissions->where('role_id', $adminRoleId)->isNotEmpty();
        });

        Gate::define('edit-conference', function ($user, $conference) {
            $adminRoleId = Role::where('name', 'admin')->first()->id;
            $chairRoleId = Role::where('name', 'chair')->first()->id;
            $isAdmin = $user->permissions->where('role_id', $adminRoleId)->isNotEmpty();
            $isChairForConference = $user->permissions->where('role_id', $chairRoleId)->where('conference_id', $conference->id)->isNotEmpty();
            return $isAdmin || $isChairForConference;
        });

        Gate::define('enroll', function ($user, $conference) {
            // Placeholder for later restrictions
            // For now everyone should be able to enroll
            return true;
        });
    }
}