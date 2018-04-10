<?php

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Measurements;
use App\Models\Brands;
use App\Models\Inputs;
use App\Models\InputDetails;

class Inventario2018 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('')->insert();
        DB::transaction(function () {
            if (($handle = fopen("./database/seeds/data/ALMACEN_ABRIL_2018.csv", "r")) !== FALSE) {
                $area_id = DB::table('locations')->insertGetId(['user_id' => 1, 'name' => 'LOGISTICA - 2018']);
                DB::table([])


                $input = new Inputs;
                $input->user_id = 1;
                $input->locations_id = $area_id;
                $input->type = 3;
                $input->save();

                $input_id = $input->id;
                
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $product = DB::table('products')->where('name', 'LIKE', "%$data[1]%")->first();
                    // print_r($product ? $product->id."\n" : "no encontrado\n");
                    if(!$product){

                        $product = new Products;
                        $product->user_id = 1;
                        $product->code = 'I2018';
                        $product->name = $data[1];
                        
                        $categorie = DB::table('categories')->where('value', 'LIKE', "$data[0]")->first();
                        // print_r( $categorie ? $categorie->id."\n" : "No hay categoria"."\n" );
                        if(!$categorie){
                            $categorie = new Categories;
                            $categorie->value = $data[0];
                            // $categorie->user_id = 1;
                            $categorie->save();
                        }
                        $product->categories_id = $categorie->id;
                        $m = DB::table('measurements')->where('value', 'LIKE', "$data[11]")->first();
                        // print_r( $m ? $m->id."\n" : "No hay m"."\n" );
                        if(!$m){
                            $m = new Measurements;
                            $m->value = $data[11];
                            // $m->user_id = 1;
                            $m->save();
                        }

                        $b = DB::table('brands')->where('value', 'LIKE', "$data[11]")->first();
                        // print_r( $b ? $b->id."\n" : "No hay B"."\n" );
                        if(!$b){
                            $b = new Brands;
                            $b->value = $data[11];
                            // $b->user_id = 1;
                            $b->save();
                        }

                        $product->measurements_id = $m->id;
                        $product->packings_id = 1;
                        $product->brands_id = $b->id;
                        $product->save();

                        echo "Nuevo Producto: ".$product->name."\n";
                    }

                    if($data[15] !== ""){
                        $input_details = InputDetails::insertGetId([
                            'user_id' => 1,
                            'products_id' => $product->id,
                            'inputs_id' => $input_id,
                            'unit_price' => 0,
                            'quantity' => $data[15]
                        ]);
                    }
                }
            }
        });
    }
}
