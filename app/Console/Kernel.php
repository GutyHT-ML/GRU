<?php

namespace App\Console;

use App\Models\Indicator;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function PHPUnit\Framework\at;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\TracingCron'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $frequency = Indicator::firstWhere('type', Indicator::$FREQ);
        $freq = 'everyMinute';
        switch ($frequency->value) {
            case 2:
                $freq = 'everyTwoMinutes';
                break;
            case 5:
                $freq = 'everyFiveMinutes';
                break;
            default:
                $freq = 'everyMinute';
                break;
        }
        $schedule->command('tracing:cron')
            ->$freq();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
