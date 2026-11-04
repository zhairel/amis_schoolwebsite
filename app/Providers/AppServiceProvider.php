<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('prayerStatus', \App\Services\IslamicPrayerService::getActivePrayerStatus());
            $view->with('hijriDate', \App\Services\IslamicPrayerService::getHijriDate());
            $view->with('dailyAyah', \App\Services\IslamicPrayerService::getDailyAyah());
        });
    }
}
