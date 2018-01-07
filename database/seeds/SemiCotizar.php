<?php

use Illuminate\Database\Seeder;
use App\Models\InputDetails;

class SemiCotizar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd(DB::select('select version()'));
        // dd(InputDetails::first());
        // $sinPrecio = InputDetails::
        //     where('unit_price', '0.000')
        //     ->get();
        // dd(count($sinPrecio));
        $noCotizado = [];
        $modificado = [];

        if (($handle = fopen("./database/seeds/data/productSemiPrices.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                
                if(floatval($data[2]) != 0){
                    $list = InputDetails::where('products_id', $data[0])
                        ->where('unit_price', '0.000')
                        ->get();

                    if(count($list) > 0){
                        // chamba
                        foreach ($list as $key => $value) {
                            $value->unit_price = $data[2];
                            $value->save();
                            echo var_dump($data);
                            $modificado[] = $value;
                        }
                    }else{
                        $noCotizado[] = [
                            'razon' => 'no faltan precios',
                            'data' => $data
                        ];    
                    }
                }else{
                    $noCotizado[] = [
                        'razon' => 'no hay precio',
                        'data' => $data
                    ];
                }
            }
        }
        // dd(
        //     // $modificado,
        //     $noCotizado
        // );
        // dd();
        // file_put_contents(
        //     "./nocotizado.json",
        //     json_encode(['noCotizados' => $noCotizado])
        // );
    }
}
