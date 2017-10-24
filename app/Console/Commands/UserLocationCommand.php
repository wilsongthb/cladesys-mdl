<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use database\seedes\UserLocationsSeeder;

class UserLocationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cladesys:userlocation {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Entrega permisos en UserLocations a Locations';

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
        $uls = new UserLocationsSeeder;
        $uls->run($this->argument('userId'));
    }
}
