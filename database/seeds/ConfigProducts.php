<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class ConfigProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [];
        // $c = 1;
        $marcas = [];
        // $m = 1;
        $empaquetados = [];
        // $e = 1;
        $unidadesDeMedida = [];
        // $u = 1;
        $productos = [];
        // $p = 1;
        
        $row = 1;
        if (($handle = fopen("./database/seeds/data/csvSource.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if(!isset($categorias[$data[0]])){
                    // $categorias[$data[0]] = $c++;
                    $categorias[$data[0]] = DB::table('categories')->insertGetId(['value' => $data[0]]);
                }
                if(!isset($marcas[$data[2]])){
                    // $marcas[$data[2]] = $c++;
                    $marcas[$data[2]] = DB::table('brands')->insertGetId(['value' => $data[2]]);
                }
                if(!isset($empaquetados[$data[3]])){
                    // $empaquetados[$data[3]] = $c++;
                    $empaquetados[$data[3]] = DB::table('packings')->insertGetId(['value' => $data[3]]);
                }
                if(!isset($unidadesDeMedida[$data[5]])){
                    // $unidadesDeMedida[$data[5]] = $c++;
                    $unidadesDeMedida[$data[5]] = DB::table('measurements')->insertGetId(['value' => $data[5]]);
                }
                // datos de producto
                $categoria = $categorias[$data[0]];
                $nombre = $data[1];
                $marca = $marcas[$data[2]];
                $empaquetado = $empaquetados[$data[3]];
                $unidades = (int)$data[4];
                $unidadDeMedida = $unidadesDeMedida[$data[5]];
        
                // stock logistica
                $stockLogistica = [
                    'minimo' => (int)$data[6],
                    'permanente' => (int)$data[7],
                    'duracion' => (int)$data[8]
                ];
                // stock ALAMACEN DE UNIDAD
                $stockUnidad = [
                    'minimo' => (int)$data[9],
                    'permanente' => (int)$data[10],
                    'duracion' => (int)$data[11]
                ];
                // stock Laboratorio
                $stockLaboratorio = [
                    'minimo' => (int)$data[12],
                    'permanente' => (int)$data[13],
                    'duracion' => (int)$data[14]
                ];

                $producto = [
                    'name' => $nombre,
                    'brands_id' => $marca,
                    'categories_id' => $categoria,
                    'measurements_id' => $unidadDeMedida,
                    'packings_id' => $empaquetado,
                    'units' => $unidades,
                    'configs' => [
                        'logistica' => $stockLogistica,
                        'unidad' => $stockUnidad,
                        'laboratorio' => $stockLaboratorio
                    ]
                ];

                array_push($productos, $producto);
            }
            fclose($handle);
        }

        // insertando datos relacionales
        // foreach ($marcas as $key => $value) {
        //     DB::table('brands')->insert(['value' => $key]);
        // }
        // foreach ($unidadesDeMedida as $key => $value) {
        //     DB::table('measurements')->insert(['value' => $key]);
        // }
        // foreach ($empaquetados as $key => $value) {
        //     DB::table('packings')->insert(['value' => $key]);
        // }
        // foreach ($categorias as $key => $value) {
        //     DB::table('categories')->insert(['value' => $key]);
        // }

        foreach ($productos as $key => $value) {
            $id = DB::table('products')->insertGetId([
                'name' => $value['name'],
                'brands_id' => $value['brands_id'],
                'categories_id' => $value['categories_id'],
                'packings_id' => $value['packings_id'],
                'measurements_id' => $value['measurements_id'],
                'user_id' => 1,
            ]);

            // var_dump($id);
            echo "product: $id".PHP_EOL;

            // config logistic
            if(
                $value['configs']['logistica']['minimo'] !== 0 OR 
                $value['configs']['logistica']['permanente'] !== 0 OR 
                $value['configs']['logistica']['duracion'] !== 0
            ){
                DB::table('product_options')->insert([
                    'user_id' => 1,
                    'locations_id' => 1,
                    'products_id' => $id,

                    'minimum' => $value['configs']['logistica']['minimo'],
                    'permanent' => $value['configs']['logistica']['permanente'],
                    'duration' => $value['configs']['logistica']['duracion']
                ]);
            }
            // config Lab
            if(
                $value['configs']['laboratorio']['minimo'] !== 0 OR 
                $value['configs']['laboratorio']['permanente'] !== 0 OR 
                $value['configs']['laboratorio']['duracion'] !== 0
            ){
                DB::table('product_options')->insert([
                    'user_id' => 1,
                    'locations_id' => 2,
                    'products_id' => $id,

                    'minimum' => $value['configs']['laboratorio']['minimo'],
                    'permanent' => $value['configs']['laboratorio']['permanente'],
                    'duration' => $value['configs']['laboratorio']['duracion']
                ]);
            }
            // config unidad
            if(
                $value['configs']['unidad']['minimo'] !== 0 OR 
                $value['configs']['unidad']['permanente'] !== 0 OR 
                $value['configs']['unidad']['duracion'] !== 0
            ){
                DB::table('product_options')->insert([
                    'user_id' => 1,
                    'locations_id' => 3,
                    'products_id' => $id,

                    'minimum' => $value['configs']['unidad']['minimo'],
                    'permanent' => $value['configs']['unidad']['permanente'],
                    'duration' => $value['configs']['unidad']['duracion']
                ]);
            }
        }

        // var_dump($productos);
    }
}
