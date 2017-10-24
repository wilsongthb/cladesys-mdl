<?php

use Illuminate\Database\Seeder;

class UserModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($userId)
    {
        DB::table('user_modules')->insert(['user_id' => $userId, 'module' => 'logistic']);
        DB::table('user_modules')->insert(['user_id' => $userId, 'module' => 'rsc']);
    }
}
