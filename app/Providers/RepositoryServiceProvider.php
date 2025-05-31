<?php

namespace App\Providers;

use App\Repositories\interfaces\InvitationRepositoryInterfaces;
use App\Repositories\interfaces\TontineRepositoryInterfaces;
use App\Repositories\interfaces\UserRepositoryInterfaces;
use App\Repositories\interfaces\WalletRepositoryInterfaces;
use App\Repositories\InvitationRepository;
use App\Repositories\TontineRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterfaces::class, UserRepository::class);
        $this->app->bind(TontineRepositoryInterfaces::class, TontineRepository::class);
        $this->app->bind(InvitationRepositoryInterfaces::class, InvitationRepository::class);
        $this->app->bind(WalletRepositoryInterfaces::class, WalletRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
