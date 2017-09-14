<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class suppliers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('suppliers')->insert([
            ['region' => 'ARQEUIPA',  'address' => ' ', 'company_name' => 'ODONTO', 'contact_name' => 'YOVANNA', 'phone' => 'YOVANNA ', 'account_number' => '2125541301013', 'bank' => 'BCP', 'email' => 'ODONTO_SRL@HOTMAIL.COM', 'observation' => "Titular: 'ODONTO SRL', - ES SERIO", 'products_stock' => ' ', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => ' ', 'contact_name' => 'HUGO', 'phone' => 'HUGO ', 'account_number' => '3720032451', 'bank' => 'SCOTIABANK', 'email' => 'ROSSMYREYESACP@HOTMAIL.COM', 'observation' => "Titular: 'ELIZABETH LEYVA CALVA', - NO ES SERIO", 'products_stock' => 'LIDOCAINA CEMENTO RESINA', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => 'DENT IMPORT', 'contact_name' => 'ALBERTO                   KARINA', 'phone' => 'ALBERTO                   KARINA ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - WATSAP - ENVIAN A PROVINCIA PA PARTIR DE 200.00", 'products_stock' => 'EQUIPOS METAL PORCELANA', 'user_id' => 1],
            ['region' => 'JULIACA',  'address' => 'CALLE SANDIA', 'company_name' => 'PERUDENTUS', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'FRESAS, REMAS, LABORATORIOS, OTROS', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => 'DENTALALICIA', 'contact_name' => 'ALICIA', 'phone' => 'ALICIA ', 'account_number' => ' ', 'bank' => ' ', 'email' => 'POR WATSAPP', 'observation' => "Titular: ' ', - ", 'products_stock' => ' ', 'user_id' => 1],
            ['region' => 'BRAZIL',  'address' => ' ', 'company_name' => 'ORTOLINEA', 'contact_name' => 'FERNANDO', 'phone' => 'FERNANDO ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - WATSAP", 'products_stock' => 'ORTODONCIA', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => 'DIDENT', 'contact_name' => 'MILEIDI', 'phone' => 'MILEIDI ', 'account_number' => ' ', 'bank' => ' ', 'email' => 'MALVARADO@DIDENT.COM.PE', 'observation' => "Titular: ' ', - WATSAP", 'products_stock' => 'GENERAL', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => 'DENTAIT VITIS', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => '5258', 'bank' => 'CONTINETAL', 'email' => ' ', 'observation' => "Titular: 'DENTAIT', - ", 'products_stock' => 'CEPILLOS, PERIOAIT', 'user_id' => 1],
            ['region' => 'TRANSP',  'address' => 'TERM T. PUNO', 'company_name' => 'CIVA', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'ENCOMIENDAS', 'user_id' => 1],
            ['region' => 'RADIOGRAFIAS',  'address' => ' ', 'company_name' => 'IMAXCENTER', 'contact_name' => 'DANAE', 'phone' => 'DANAE ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'RAD. PAMORAMICA, LATERALES', 'user_id' => 1],
            ['region' => 'TECNICO',  'address' => ' ', 'company_name' => ' ', 'contact_name' => 'ABELARDO', 'phone' => 'ABELARDO ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - NO ES SERIO", 'products_stock' => 'MANTENIMIENTO REPARACION EQUIPOS DENTALES', 'user_id' => 1],
            ['region' => 'TECNICO',  'address' => ' ', 'company_name' => ' ', 'contact_name' => 'MARIO C RAMIREZ CHAIÑA', 'phone' => 'MARIO C RAMIREZ CHAIÑA ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'MANTENIMIENTO REPARACION EQUIPOS DENTALES', 'user_id' => 1],
            ['region' => 'JULIACA',  'address' => ' ', 'company_name' => 'ODONTOMEDIC', 'contact_name' => 'CARLOS', 'phone' => 'CARLOS ', 'account_number' => ' ', 'bank' => ' ', 'email' => 'ODONTOMEDIC_JULIACA@HOTMAIL.COM', 'observation' => "Titular: ' ', - ", 'products_stock' => ' ', 'user_id' => 1],
            ['region' => 'PUNO',  'address' => ' ', 'company_name' => 'SAVIDENT', 'contact_name' => 'SAVI', 'phone' => 'SAVI ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'GENERAL', 'user_id' => 1],
            ['region' => 'ARQEUIPA',  'address' => ' ', 'company_name' => 'DELTAQUIMICA', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'CLOROXIDINA 2% Y 12% EN LIQUIDO', 'user_id' => 1],
            ['region' => 'JULIACA',  'address' => ' ', 'company_name' => 'DENTAL FRESIDENT', 'contact_name' => 'RICARDO', 'phone' => 'RICARDO ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => ' ', 'user_id' => 1],
            ['region' => 'LIMA',  'address' => ' ', 'company_name' => 'BUFALO', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => ' ', 'user_id' => 1],
            ['region' => 'BRAZIL',  'address' => ' ', 'company_name' => ' ', 'contact_name' => ' ', 'phone' => ' ', 'account_number' => ' ', 'bank' => ' ', 'email' => ' ', 'observation' => "Titular: ' ', - ", 'products_stock' => 'RESINAS', 'user_id' => 1],
        ]);
        
    }
}
