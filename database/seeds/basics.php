<?php
/*
Informacion basica para el funcionamiento de la aplicacion y la base de datos
*/

use Illuminate\Database\Seeder;
use \DB as DB;

class basics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'root',
            'email' => 'root@localhost',
            'password' => bcrypt('root')
        ]);
    }   
}
