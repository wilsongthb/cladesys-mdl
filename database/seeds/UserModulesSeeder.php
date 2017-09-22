<?php

use Illuminate\Database\Seeder;

class UserModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_modules')->insert(['user_id' => '1', 'module' => 'logistic']);
        DB::table('user_modules')->insert(['user_id' => '1', 'module' => 'rsc']);
        DB::table('user_modules')->insert(['user_id' => '1', 'module' => 'orders/print']);
        DB::table('user_modules')->insert(['user_id' => '1', 'module' => 'purchase-order']);
    }
}
