<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Calendar::observe(\App\Observers\CalendarObserver::class);
        \App\Models\Setting::observe(\App\Observers\SettingObserver::class);
    }
}
