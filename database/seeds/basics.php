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
        DB::table('permissions')->insert(['user_id' => '1','permission' => '2']);
        DB::table('permissions')->insert(['user_id' => '1','permission' => '3']);
        DB::table('permissions')->insert(['user_id' => '1','permission' => '4']);
        DB::table('permissions')->insert(['user_id' => '1','permission' => '5']);
        // DB::table('permissions')->insert(['user_id', '1','permission', '2']);

        DB::table('locations')->insert([
            [// id 1
                'type' => '1',
                'name' => 'ALMACEN GENERAL',
                'utility' => '5',
                'user_id' => '1'
            ],
            [// 2
                'type' => '2',
                'name' => 'AREA DE LABORATORIO',
                'utility' => '0',
                'user_id' => '1'
            ],
            [// 3
                'type' => '2',
                'name' => 'UNIDAD CLINICA CHARISMA',
                'utility' => '0',
                'user_id' => '1'
            ],
            [
                'type' => '2',
                'name' => 'AREA DE RECEPCION',
                'utility' => '0',
                'user_id' => '1'
            ],
            [
                'type' => '2',
                'name' => 'AREA DE RADIOLOGIA',
                'utility' => '0',
                'user_id' => '1'
            ],
            [
                'type' => '2',
                'name' => 'AREA DE BIOSEGURIDAD',
                'utility' => '0',
                'user_id' => '1'
            ]
        ]);
    }   
}
