<?php

namespace App\Providers;

use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Transport;
use App\Observers\ServiceSeoObserver;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Tour::observe(ServiceSeoObserver::class);
        Hotel::observe(ServiceSeoObserver::class);
        Transport::observe(ServiceSeoObserver::class);
    }
}
