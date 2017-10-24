<?php

use Illuminate\Foundation\Inspiring;
use \DB as DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command(
    'ul {userId}',
    function ($userId) {
        $uls = new UserLocationsSeeder;
        $uls->run($userId);
    }
)->describe('AUXS');

Artisan::command(
    'um {userId}',
    function ($userId) {
        $uls = new UserModulesSeeder;
        $uls->run($userId);
    }
)->describe('AUXS');