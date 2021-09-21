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

        //
        // Gate::define('admin', function ($user) {
        //     if ($user->roles[0]['pivot']['role_id'] === config('setting.role.admin'))
        //         return true;
        // });

        // Gate::define('mod', function ($user) {
        //     if ($user->roles[0]['pivot']['role_id'] === config('setting.role.mod'))
        //         return true;
        // });
    }
}
