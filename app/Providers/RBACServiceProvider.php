<?php

namespace App\Providers;

use App\Services\RBACService\RBACService;
use App\Services\RBACService\RBACServiceInterface;
use Illuminate\Support\ServiceProvider;

class RBACServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RBACServiceInterface::class, RBACService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
