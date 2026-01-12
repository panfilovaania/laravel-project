<?php

namespace App\Providers;

use App\Repositories\AuthRepo\AuthRepoInterface;
use App\Repositories\AuthRepo\EloquentAuthRepo;
use App\Repositories\ResourceRepo\EloquentResourceRepo;
use App\Repositories\ResourceRepo\ResourceRepoInterface;
use App\Repositories\ServiceRepo\EloquentServiceRepo;
use App\Repositories\UserRepo\EloquentUserRepo;
use App\Repositories\ServiceRepo\ServiceRepoInterface;
use App\Repositories\UserRepo\UserRepoInterface;
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
        $this->app->bind(UserRepoInterface::class, EloquentUserRepo::class);
        $this->app->bind(AuthRepoInterface::class, EloquentAuthRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
