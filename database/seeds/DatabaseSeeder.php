<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(basics::class);
        $this->call(locationsSeeder::class);
        $this->call(UserModulesSeeder::class);
        $this->call(suppliers::class);
        // $this->call(products::class);
        $this->call(UserLocationsSeeder::class);
        $this->call(ConfigProducts::class);
        
    }
}
