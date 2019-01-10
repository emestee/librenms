<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use LibreNMS\Util\Version;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the custom commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Closure-based general commands
        require base_path('routes/console.php');

        // Developer commands
        if ($this->app->environment() !== 'production') {
            $prefix = "App\Console\Commands\Developer\\";
            $this->commands[] = $prefix . 'ReleaseTag';
        }
    }

    protected function getArtisan()
    {
        if (is_null($this->artisan)) {
            parent::getArtisan();
            $this->artisan->setName(\LibreNMS\Config::get('project_name', 'LibreNMS'));
            $this->artisan->setVersion(Version::get()->local());
        }

        return $this->artisan;
    }
}
