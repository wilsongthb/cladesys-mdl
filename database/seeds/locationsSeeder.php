<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class locationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
