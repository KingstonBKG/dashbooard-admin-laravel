<?php

namespace App\Providers;

use App\Repositories\interfaces\InvitationRepositoryInterfaces;
use App\Repositories\interfaces\PaiementRepositoryInterfaces;
use App\Repositories\interfaces\TontineRepositoryInterfaces;
use App\Repositories\interfaces\UserRepositoryInterfaces;
use App\Repositories\interfaces\WalletRepositoryInterfaces;
use App\Repositories\interfaces\WalletTontineRepositoryInterfaces;
use App\Repositories\InvitationRepository;
use App\Repositories\PaiementRepository;
use App\Repositories\TontineRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Repositories\WalletTontineRepository;
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
        $this->app->bind(WalletTontineRepositoryInterfaces::class, WalletTontineRepository::class);
        $this->app->bind(PaiementRepositoryInterfaces::class, PaiementRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
