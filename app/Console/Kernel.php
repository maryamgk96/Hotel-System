<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\sendemail;
use DateTime;
use App\Client;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->command('check:last_login')->daily()->when(function () {
            $clients=Client::all();
            $today = date('Y-m-d H:i:s');
            $lastlogin = ($client->last_login);
            $datetime1 = new DateTime($today);
            $datetime2 = new DateTime($lastlogin);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            foreach($clients as $client)
            {
                if($days>=30)
                {
                    $client->notify(new sendemail($client));      
                    return ("done");
                }
            }
        });
      
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
