<?php

namespace App\Providers;

use App\Repositories\AuthRepo\AuthRepoInterface;
use App\Repositories\AuthRepo\EloquentAuthRepo;
use App\Repositories\BookingRepo\BookingRepoInterface;
use App\Repositories\BookingRepo\EloquentBookingRepo;
use App\Repositories\ResourceRepo\EloquentResourceRepo;
use App\Repositories\ResourceRepo\ResourceRepoInterface;
use App\Repositories\ServiceRepo\EloquentServiceRepo;
use App\Repositories\UserRepo\EloquentUserRepo;
use App\Repositories\ServiceRepo\ServiceRepoInterface;
use App\Repositories\TimesheetRepo\EloquentTimesheetRepo;
use App\Repositories\TimesheetRepo\TimesheetRepoInterface;
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
        $this->app->bind(BookingRepoInterface::class, EloquentBookingRepo::class);
        $this->app->bind(TimesheetRepoInterface::class, EloquentTimesheetRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
