<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Generate sitemap daily at midnight for SEO optimization
        $schedule->command('sitemap:generate')
            ->dailyAt('00:00')
            ->name('sitemap-generation')
            ->withoutOverlapping()
            ->onSuccess(function () {
                \Log::info('✅ Sitemap generated successfully at ' . now());
            })
            ->onFailure(function () {
                \Log::error('❌ Sitemap generation failed at ' . now());
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
