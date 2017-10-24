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
        $locations = DB::table('locations')->get();

        $reg = [];

        foreach ($locations as $key => $value) {
            array_push($reg, ['user_id' => '1', 'locations_id' => $value->id]);
        }

        DB::table('user_locations')->insert($reg);
    }
}
