<?php

namespace App\Providers;

use App\Repositories\WeeklyPlanRepository;
use App\Repositories\WeeklyPlanRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeeklyPlanRepositoryInterface::class, WeeklyPlanRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
