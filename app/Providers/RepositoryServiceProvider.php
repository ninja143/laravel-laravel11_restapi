<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PlayerRepositoryInterface;
use App\Repositories\PlayerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PlayerRepositoryInterface::class,PlayerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
