<?php

namespace App\Providers;

use App\Repositories\ResourceRepo\EloquentResourceRepo;
use App\Repositories\ResourceRepo\ResourceRepoInterface;
use App\Repositories\ServiceRepo\EloquentServiceRepo;
use App\Repositories\ServiceRepo\ServiceRepoInterface;
use Illuminate\Support\ServiceProvider;

class ReposServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepoInterface::class, EloquentServiceRepo::class);
        $this->app->bind(ResourceRepoInterface::class, EloquentResourceRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
