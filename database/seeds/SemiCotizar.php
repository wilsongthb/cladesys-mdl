<?php

use Illuminate\Database\Seeder;
use App\Models\InputDetails;
use App\Models\Inputs;
use App\Models\OutputDetails;
use App\Models\Outputs;

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
                            // echo var_dump($data);
                            print_r($data);

                            $value->unit_price = $data[2];
                            $value->save();

                            $input = Inputs::find($value->inputs_id);
                            $input->observation = ($input->observation ? $input->observation : '') . "
AutoCotizacion: ($data[0], $value->id) - $data[1]";
                            $input->save();
                            
                            $outs = [];

                            // buscando salidas sin precio
                            $outdets = OutputDetails::where('input_details_id', $value->id)
                                ->where('unit_price', '0.000')
                                ->get();

                            

                            foreach ($outdets as $key => $outdet) {
                                // registrando cambio en cabecera
                                $output = Outputs::find($outdet->outputs_id);
                                $output->observation = ($output->observation ? $output->observation : '') . "
AutoCotizar: ($data[0], $value->id, $outdet->id) - $data[1]";
                                $output->save();

                                // registrando cambio en detalle
                                $outdet->unit_price = $data[2];
                                $outdet->real_unit_price = $data[2];
                                $outdet->save();

                                $outs[] = [
                                    // 'out' => $output->id,
                                    'dets' => $outdet
                                ];
                            }

                            
                            $modificado[] = [
                                'input' => $input,
                                'input_detail' => $value,
                                'outs' => $outs,

                            ];
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
        file_put_contents(
            "./nocotizado.json",
            json_encode([
                'cotizado' => $modificado,
                'noCotizados' => $noCotizado
            ])
        );
    }
}

