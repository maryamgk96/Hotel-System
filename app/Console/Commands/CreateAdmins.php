<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class CreateAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin  {--username= : The name of admin} {--email= : The email of admin}  {--password= : The password of admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create other admins';

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
        if($this->option('username') && $this->option('email') && $this->option('password')){
            User::create([
                'name' =>$this->option('username'),
                'email' => $this->option('email'),
                'password'=>bcrypt($this->option('password')),
            ])->assignRole('admin');
        }
        else{
            $this->error('Not enough arguments');
        }
        
    }

    
}
