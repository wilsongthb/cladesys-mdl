<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class UserLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_locations')->insert([
            ['user_id' => '1', 'locations_id' => '1'],
            ['user_id' => '1', 'locations_id' => '2'],
            ['user_id' => '1', 'locations_id' => '3'],
            ['user_id' => '1', 'locations_id' => '4'],
            ['user_id' => '1', 'locations_id' => '5'],
            ['user_id' => '1', 'locations_id' => '6']
        ]);
    }
}
