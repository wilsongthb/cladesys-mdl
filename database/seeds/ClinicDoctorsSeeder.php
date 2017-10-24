<?php

use Illuminate\Database\Seeder;

class ClinicDoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinic_doctors')->insert([
            ['names' => 'Dr(a). Aquise Apaza, Jeanina', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Barra Maldonado , Marylin ', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Coila Pilco, Rosa Edhy', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Flores Calderon, Myrcea Rossyel', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Manzaneda Peña, Alina', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Molina Mengoa, Degly', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Navarro Gamarra, Nohelia ', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Nuñez Morales , Lizbeth', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Olguin Medina, Ingrith ', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Quispe Berrios, Yised', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Quispe Maquera, Beatriz', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
            ['names' => 'Dr(a). Tuero Chirinos, Kandy', 'fam_names' => '_', 'dni' => '_', 'user_id' => '1'],
        ]);
    }
}
