<?php

namespace App\Providers;

use App\Services\Resource\ResourceService;
use App\Services\Resource\ResourceServiceInterface;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ResourceServiceInterface::class, ResourceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
