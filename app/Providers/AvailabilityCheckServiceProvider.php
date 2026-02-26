<?php

namespace App\Providers;

use App\Services\Booking\AvailabilityCheckService;
use App\Services\Booking\AvailabilityCheckServiceInterface;
use Illuminate\Support\ServiceProvider;

class AvailabilityCheckServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AvailabilityCheckServiceInterface::class, AvailabilityCheckService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
