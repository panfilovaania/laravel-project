<?php

namespace App\Providers;

use App\Services\Timesheet\TimesheetService;
use App\Services\Timesheet\TimesheetServiceInterface;
use Illuminate\Support\ServiceProvider;

class TimesheetServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TimesheetServiceInterface::class, TimesheetService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
