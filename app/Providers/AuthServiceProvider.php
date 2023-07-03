<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('isAdmin', 'App\Policies\UserAuthPolicy@isAdmin');
        Gate::define('isUser', 'App\Policies\UserAuthPolicy@isUser');

        //controller access
        Gate::define('contorllerAccess', 'App\Policies\UserAuthPolicy@contorllerAccess');
    }
}
