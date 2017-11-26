<?php

use Illuminate\Database\Seeder;
use \App\Models\Products;
use \App\Models\InputDetails;
use \App\Models\OutputDetails;

class ReconfigurePricesIO extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saveChanges = true;
        $reports = [
            'noProducts' => []
        ];

        if (($handle = fopen("./database/seeds/data/productPrices.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $product = Products::where('name', 'LIKE', "%$data[1]%")->first();
                $data[2] = isset($data[2]) ? $data[2] : '0';
                if($product){
                    $inputDetails = InputDetails::where('products_id', $product->id)
                        ->where('unit_price', '0')
                        ->get();
                    foreach ($inputDetails as $key => $value) {
                        $value->unit_price = $data[2];
                        if($saveChanges) $value->save(); // guardar
                    }
                    // dd($inputDetails);Z
                    

                    $outputDetails = OutputDetails::
                        select('od.*')
                        ->from('output_details AS od')
                        ->leftJoin('input_details AS id', 'od.input_details_id', 'id.id')
                        ->where('id.products_id', $product->id)
                        ->where('od.unit_price', '0')
                        ->get();
                    foreach ($outputDetails as $key => $value) {
                        $value->unit_price = floatval($data[2]) + (floatval($data[2]) * floatval($value->utility) / 100);
                        $value->real_unit_price = floatval($data[2]);
                        if($saveChanges) $value->save(); // guardar
                    }
                    // dd($outputDetails);
                }else{
                    $reports['noProducts'][] = $data;
                }


                // dd($product);
                // exit;
            }
        }

        dd($reports);
    }
}
