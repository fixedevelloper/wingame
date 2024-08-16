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
        $schedule->command('app:create-fixture')->hourly();
        $schedule->command('app:load-over')->everySixHours();
        $schedule->command('app:team-event-command')->at("03:00");
        $schedule->command('app:create-standing')->at("02:00");
        $schedule->command('app:create-fixure-event')->dailyAt("01:25");
        $schedule->command('app:league-day')->dailyAt("01:30");
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
