<?php

namespace App\Providers;

use App\Models\Tontine;
use App\Policies\TontinePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     */
    public function registerPolicies(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Tontine::class, TontinePolicy::class);
    }
}
