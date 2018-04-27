<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\sendemail;
use App\Client;
use DateTime;

class mail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:last_login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clients=Client::all();
        foreach($clients as $client)
        {
            $today = date('Y-m-d H:i:s');
            $lastlogin = ($client->last_login);
            $datetime1 = new DateTime($today);
            $datetime2 = new DateTime($lastlogin);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            if($days>30)
            {
                $client->notify(new sendemail($client));      
                return ("done");
            }
        }
    }
}
