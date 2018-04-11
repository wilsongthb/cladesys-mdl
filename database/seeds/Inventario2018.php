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
                $logistica = DB::table('locations')->insertGetId(['user_id' => 1, 'name' => 'LOGISTICA - 2018']);
                $unidad = DB::table('locations')->insertGetId(['user_id' => 1, 'name' => 'ALMACEN DE UNIDAD - 2018']);
                $laboratorio = DB::table('locations')->insertGetId(['user_id' => 1, 'name' => 'LABORATORIO - 2018']);
                
                DB::table('user_locations')->insert([
                    ['user_id' => 1, 'locations_id' => $logistica],
                    ['user_id' => 1, 'locations_id' => $unidad],
                    ['user_id' => 1, 'locations_id' => $laboratorio],
                ]);

                print_r([$unidad, $logistica, $laboratorio]);

                $input1 = new Inputs;
                $input1->user_id = 1;
                $input1->locations_id = $logistica;
                $input1->type = 3;
                $input1->save();

                $input2 = new Inputs;
                $input2->user_id = 1;
                $input2->locations_id = $unidad;
                $input2->type = 3;
                $input2->save();

                $input3 = new Inputs;
                $input3->user_id = 1;
                $input3->locations_id = $laboratorio;
                $input3->type = 3;
                $input3->save();
                
                $product = new stdClass;
                $product->name = "";

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $productl = $product;
                    $product = DB::table('products')->where('name', 'LIKE', "%$data[1]%")->first();
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

                        echo "Nuevo Producto: ".$product->name.$product->id."\n";
                    }
                    echo "Existente Producto: ".$product->name.$product->id."\n";

                    if($product->name != $productl->name){
                        /**INSERTANDO EN UNIDAD */
                        echo "UNIDAD\n";
                        $cantMin = 0;
                        $cantPer = 0;
                        if($data[5] != ""){
                            $cantPer = $data[5];
                            if($data[4] != ""){
                                $cantMin = $data[4];
                            }
                            DB::table('product_options')->insert([
                                'user_id' => 1,
                                'minimum' => $cantMin,
                                'permanent' => $cantPer,
                                'products_id' => $product->id,
                                'locations_id' => $unidad
                            ]);
                            DB::table('input_details')->insert([
                                'user_id' => 1,
                                'products_id' => $product->id,
                                'inputs_id' => $input2->id,
                                'unit_price' => 0,
                                'quantity' => $cantPer ? $cantPer : $cantMin
                            ]);
                        }

                        /**INSERTAR A LABORATORIO */
                        echo "LABORATORIO\n";
                        $cantMin = 0;
                        $cantPer = 0;
                        if($data[9] != ""){
                            $cantPer = $data[9];
                            if($data[8] != ""){
                                $cantMin = $data[8];
                            }
                            DB::table('product_options')->insert([
                                'user_id' => 1,
                                'minimum' => $cantMin,
                                'permanent' => $cantPer,
                                'products_id' => $product->id,
                                'locations_id' => $laboratorio
                            ]);
                            DB::table('input_details')->insert([
                                'user_id' => 1,
                                'products_id' => $product->id,
                                'inputs_id' => $input3->id,
                                'unit_price' => 0,
                                'quantity' => $cantPer ? $cantPer : $cantMin
                            ]);
                        }


                        /**INSERTAR A LOGISTICA */
                        echo "LOGISTICA\n";
                        $cantMin = 0;
                        $cantPer = 0;
                        if($data[9] != ""){
                            $cantPer = $data[9];
                            if($data[8] != ""){
                                $cantMin = $data[8];
                            }
                            DB::table('product_options')->insert([
                                'user_id' => 1,
                                'minimum' => $cantMin,
                                'permanent' => $cantPer,
                                'products_id' => $product->id,
                                'locations_id' => $logistica
                            ]);
                            
                        }

                        if($data[15] !== ""){
                            DB::table('input_details')->insert([
                                'user_id' => 1,
                                'products_id' => $product->id,
                                'inputs_id' => $input1->id,
                                'unit_price' => 0,
                                'quantity' => $data[15]
                            ]);
                        }
                    }
                    
                }
            }
        });
    }
}
