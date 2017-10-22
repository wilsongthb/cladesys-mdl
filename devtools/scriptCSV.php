<?php

$categorias = [];
$c = 1;
$marcas = [];
$m = 1;
$empaquetados = [];
$e = 1;
$unidadesDeMedida = [];
$u = 1;

$row = 1;
if (($handle = fopen("csvSource.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $num = count($data);
        // echo "<p> $num fields in line $row: <br /></p>\n";
        // $row++;
        // for ($c=0; $c < $num; $c++) {
        //     echo $data[$c] . "<br />\n";
        // }
        // var_dump($data);
        if(!isset($categorias[$data[0]])){
            $categorias[$data[0]] = $c++;
        }
        if(!isset($marcas[$data[2]])){
            $marcas[$data[2]] = $c++;
        }
        if(!isset($empaquetados[$data[3]])){
            $empaquetados[$data[3]] = $c++;
        }
        if(!isset($unidadesDeMedida[$data[5]])){
            $unidadesDeMedida[$data[5]] = $c++;
        }
        // datos de producto
        $categoria = $categorias[$data[0]];
        $nombre = $data[1];
        $marca = $marcas[$data[2]];
        $empaquetado = $empaquetados[$data[3]];
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

        // var_dump([
        //     $nombre,
        //     $stockLogistica,
        //     $stockUnidad,
        //     $stockLaboratorio
        // ]);
    }
    fclose($handle);
}

// var_dump($categorias, $marcas);
// var_dump($empaquetados, $unidadesDeMedida);