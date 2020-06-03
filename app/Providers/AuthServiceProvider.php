<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->registerUserPolicies();
        //
    }
    public function registerUserPolicies(){
        Gate::define('create-users', function($user){
           return $user->hasAccess(['create-users']);
        });
        Gate::define('update-users', function($variable){
            return $variable->hasAccess(['update-users']);
         });
         Gate::define('read-users', function($variable){
            return $variable->hasAccess(['read-users']);
         });
         Gate::define('delete-users', function($variable){
            return $variable->hasAccess(['delete-users']);
         });
    }
}
