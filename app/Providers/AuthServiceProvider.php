<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /* define a super admin role */
        Gate::define('isSuper', function($user) {
            if ($user->role->slug == 'super') {
                return true;
            }
            return false;
        });

        /* define a admin role */
        Gate::define('isAdmin', function($user) {
            if ($user->role->slug == 'admin') {
                return true;
            }
            return false;
        });

        /* define a accountent role */
        Gate::define('isStaff', function($user) {
            if($user->role->slug == 'staff'){
                return true;
            }
            return false;
        });

        /* define a project manager role */
        Gate::define('isProjectManager', function($user) {
            if($user->role->slug == 'project_manager'){
                return true;
            }
            return false;
        });

        /* define a product manager role */
        Gate::define('isProductManager', function($user) {
            if($user->role->slug == 'product_manager'){
                return true;
            }
            return false;
        });

        /* define a selles manager role */
        Gate::define('isSellesManager', function($user) {
            if($user->role->slug == 'selles_manager'){
                return true;
            }
            return false;
        });

        /* define a purchase manager role */
        Gate::define('isPurchaseManager', function($user) {
            if($user->role->slug == 'purchase_manager'){
                return true;
            }
            return false;
        });

        /* define a client portal role */
        Gate::define('isClientPortal', function($user) {
            if ($user->role->slug == 'client_portal') {
                return true;
            }
            return false;
        });
    }
}
