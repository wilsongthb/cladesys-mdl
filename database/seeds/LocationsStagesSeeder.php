<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class LocationsStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd(DB::select('SELECT 1+1'));
        DB::table('locations_stages')->insert([
            ['locations_id' => 1, 'start' => '2017-01-01 00:00:00', 'end' => '2018-01-01 00:00:00', 'name' => '2017', 'user_id' => 1],
            ['locations_id' => 6, 'start' => '2017-08-01 00:00:00', 'end' => '2017-12-01 00:00:00', 'name' => '2017 AGOSTO A NOVIEMBRE', 'user_id' => 1],
            ['locations_id' => 6, 'start' => '2017-12-01 00:00:00', 'end' => '2018-01-01 00:00:00', 'name' => '2017 DICIEMBRE', 'user_id' => 1],
        ]);
    }
}
