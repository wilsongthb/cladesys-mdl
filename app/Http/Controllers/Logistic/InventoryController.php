<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\InputDetails;
use App\Models\OutputDetails;

class InventoryController extends Controller
{
    /**
     * INPUT QUANTITY SELECT
     * Es una funcion que forma parte del grupo de funciones
     * que sirven para calcular el stock de los productos
     * @return QueryBuilder
     */
    private function productsQuantity(){
        $result = InputDetails::
            select(
                'id.products_id',
                DB::raw('ROUND(SUM(id.quantity * id.unit_price)/SUM(id.quantity), 2) AS price'),
                DB::raw('COUNT(id.id) AS total_input_details'),
                DB::raw('SUM(id.quantity) AS id_quantity_sum'),
                DB::raw('MAX(id.created_at) AS id_last_time')
            )->
            from('input_details AS id')->
            groupBy('id.products_id')->
            leftJoin('inputs AS i', 'i.id', 'id.inputs_id')->
            // condicion de anulacion
            where('id.flagstate', true)->
            where('i.flagstate', true);
        return $result;
    }

    /**
     * PRODUCTS SEARCH
     * Sirve para buscar o filtrar los input_details
     * por el nombre de un producto
     * @return QueryBuilder
     */
    private function productsSearch($str = ""){
        $res = $this->productsQuantity();
        if(count($str) > 0){
            $res = $res->
                leftJoin('products AS p', 'p.id', 'id.products_id')->
                leftJoin('packings AS pa', 'pa.id', '=', 'p.packings_id')->
                leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')->
                leftJoin('brands AS b', 'b.id', '=', 'p.brands_id')->
                leftJoin('measurements AS m', 'm.id', '=', 'p.measurements_id')
                ->where('p.name', 'LIKE', "%$str%") // product
                ->orWhere('p.code', 'LIKE', "%$str%") // product code
                ->orWhere('pa.value', 'LIKE', "%$str%") // packing
                ->orWhere('c.value', 'LIKE', "%$str%") // categorie
                ->orWhere('b.value', 'LIKE', "%$str%") // brand
                ->orWhere('m.value', 'LIKE', "%$str%"); // measurement
        }
        return $res;
    }

    /**
     * INSERT PRODUCTS
     * inserta objetos producto a la lista
     * segun la clave products_id de cada fila
     * @param Array ['products_id => val]
     */
    public function insertProducts(&$list){
        foreach ($list as $key => &$value) {
            // precio real
            $value->product = ProductsController::show($value->products_id);
        }
    }

    /**
     * STOCK CALCULATOR
     * @param QueryBuilder
     * recibe como parametro un array resultado de productsQuantity
     * las funciones anteriores, y calcula el stock de
     * esos products 
     */
    public function stockCalculator(&$list, $locations_id = 0){
        // calcular stock
        foreach ($list as $key => &$value) {
            $od = OutputDetails::
                select(
                    // 'od.*',
                    // 'o.locations_id'
                    DB::raw('COUNT(od.id) AS total_output_details'),
                    DB::raw('SUM(IFNULL(od.quantity, 0)) AS od_quantity_sum'),
                    DB::raw('MAX(od.created_at) AS od_last_time')
                )->
                from('output_details AS od')->
                leftJoin('outputs AS o', 'o.id', 'od.outputs_id')->
                leftJoin('input_details AS id', 'id.id', 'od.input_details_id')->
                leftJoin('inputs AS i', 'i.id', 'id.inputs_id')->
                where('id.flagstate', true)->
                where('i.flagstate', true)->
                where('od.flagstate', true)->
                where('o.flagstate', true)->
                where('id.products_id', $value->products_id)->
                groupBy('id.products_id');
            if($locations_id !== 0){
                $od = $od
                    ->where('i.locations_id', $locations_id)
                    ->where('o.locations_id', $locations_id);
            }
            // dd($od->get());
            $od = $od->first();
            // determinar stock
            if($od){
                $value->od_quantity_sum = $od->od_quantity_sum;
                $value->stock = $value->id_quantity_sum - $value->od_quantity_sum;
                $value->od_last_time = $od->od_last_time;
            }else{
                $value->od_quantity_sum = 0;
                $value->stock = $value->id_quantity_sum;
            }
        }
    }

    /**
     * KARDEX DE PRODUCTO
     * muestra kardex de un producto en un almacen o area
     */
    public function kardex($locations_id, $products_id, $showDeletes = false){
        $res = DB::select(
        "SELECT
            k.*
        FROM (SELECT
            'ENTRADA' AS type,
            id.id AS id,
            i.id AS h_id,
            id.quantity AS input_quantity,
            id.unit_price AS input_price,
            '' AS output_quantity,
            '' AS output_price,
            id.created_at AS datetime
        FROM input_details AS id
        LEFT JOIN inputs AS i ON i.id = id.inputs_id
        WHERE 
            id.flagstate = true AND
            i.flagstate = true AND
            i.locations_id = '$locations_id' AND
            id.products_id = '$products_id'

        UNION
         
        SELECT
            'SALIDA' AS type,
            od.id AS id,
            o.id AS h_id,
            '' AS input_quantity,
            '' AS input_price,
            od.quantity AS output_quantity,
            od.unit_price AS output_price,
            od.created_at AS datetime
        FROM output_details AS od
        LEFT JOIN outputs AS o ON o.id = od.outputs_id
        LEFT JOIN input_details AS id ON id.id = od.input_details_id
        LEFT JOIN inputs AS i ON i.id = id.inputs_id
        WHERE 
            id.flagstate = true AND
            i.flagstate = true AND
            od.flagstate = true AND
            o.flagstate = true AND
            i.locations_id = '$locations_id' AND
            id.products_id = '$products_id') AS k
        ORDER BY k.datetime ASC
        ");
        return $res;
    }

    /**
     * HITORIAL DE PRODUCTO
     * Muestra un listado de todos los movimientos de un producto en algun almacen
     * @param $locations_id
     * @param $products_id
     * @param @mostrar los eliminados
     */
    public function historyProduct($locations_id, $product_id, $showDeletes = false){
        // entradas
        $inputs = InputDetails::
            select('id.*')->
            from('input_details AS id')->
            join('inputs AS i', 'i.id', 'id.inputs_id')->
            where('id.flagstate', true);
        if(!$showDeletes){
            $inputs = $inputs->
                where('i.flagstate', true)->
                where('id.products_id', $product_id);
        }
        if($locations_id !== 0){
            $inputs = $inputs->
                where('i.locations_id', $locations_id);
        }
        $inputs = $inputs->get();

        // salidas
        $qr = OutputDetails::
            select('od.*')->
            from('output_details AS od')->
            leftJoin('outputs AS o', 'o.id', 'od.outputs_id');
        if(!$showDeletes){
            $qr = $qr->
                where('od.flagstate', true)->
                where('o.flagstate', true);
        }
        $outputs_ids =  [];
        foreach ($inputs as $key => $value) {
            $outputs_ids[] = $value->id;
        }
        $qr = $qr->whereIn('od.input_details_id', $outputs_ids);
        return [
            // 'product' => ProductsController::show($product_id),
            'inputs' => $inputs,
            'outputs' => $qr->get()
        ];
    }

    /**
     * STOCK FROM INPUT DETAILS
     * Se encarga de calcular el stock de cada una de las entradas
     * de un producto, util para la clase OutputsController@finalUse
     * @return un array con el resultado, una lista de entradas
     */
    public function stockFromInputDetails(
        $locations_id = false, 
        /**
         * ID del area para calcular su inputStock
         * si no se especifica no se realiza la condicion
         */
        $products_id = false, 
        /**
         * ID del producto
         * de no especificarse, se calcula de los productos
         * de los cuales hay registro de ingreso en el area
         */
        $onlyPositives = false
        /**
         * Sirve para definir si mostrar solo a las filas
         * mayores a cero
         */
    ){
        $productCondicion = $products_id ? "AND id.products_id = '$products_id'" : "";
        $locationCondicion = $locations_id ? "AND i.locations_id = '$locations_id'" : "";
        $onlyPositivesCondicion = $onlyPositives ? "WHERE s.stock > 0" : "";
        $sql = 
        "SELECT
            s.*
        FROM (SELECT
                COUNT(od.id) AS count_outputs,
                SUM(IFNULL(od.quantity, 0)) AS sum_od_quantity,
                CONVERT(id.quantity - SUM(IFNULL(od.quantity, 0)), SIGNED INTEGER) AS stock,

                -- retrocompatibilidad
                SUM(IFNULL(od.quantity, 0)) AS od_total,
                MAX(IFNULL(od.created_at, '')) AS od_last_time,
                l.name AS locations_name,

                -- CONVERT(SUBSTRING_INDEX(field,'-',-1),UNSIGNED INTEGER)
                -- i.flagstate AS i_f,
                -- id.flagstate AS id_f,
                -- o.flagstate AS o_f,
                -- od.flagstate AS od_f,
                -- od.id AS od_id,
                id.*
            FROM input_details AS id
            LEFT JOIN inputs AS i ON i.id = id.inputs_id
            LEFT JOIN output_details AS od ON od.input_details_id = id.id
            LEFT JOIN outputs AS o ON o.id = od.outputs_id

            -- retrocompatibilidad
            LEFT JOIN locations AS l ON l.id = i.locations_id

            -- condiciones con flagstate
            WHERE true
            AND id.flagstate = true
            AND i.flagstate = true
            AND IFNULL(od.flagstate, true) = true
            AND IFNULL(o.flagstate, true) = true

            $locationCondicion
            $productCondicion

            GROUP BY id.id
            ORDER BY id.products_id ASC
        ) AS s
        $onlyPositivesCondicion
        ";
        $res = DB::select($sql);
        // $this->insertProducts($res);
        return $res;
        // return $sql;
    }

    /**
     * INVENTORY BY LOCATION
     * 
     * Funcion que calcula el inventario de forma interna
     * @param $locations_id - ID DEL AREA
     */
    public function inventoryByLocation($locations_id){
        // calcula cantidad total ingresada
        $res = $this->productsQuantity()->
            where('i.locations_id', $locations_id)->
            get();

        $this->stockCalculator($res, $locations_id);
        $this->insertProducts($res);

        return $res;
    }

    /**
     * 
     * REAL PRICE
     * Calcula el precio real de un producto en un area en especifico
     * 
     */
    public function real_price($locations_id, $products_id){
        return DB::select(DB::raw(
            "SELECT 
                SUM(id.quantity * id.unit_price)/SUM(id.quantity) AS real_price,
                p.name AS p_name
            FROM input_details AS id
            JOIN products AS p ON p.id = id.products_id
            JOIN inputs AS i ON i.id = id.inputs_id
            WHERE i.locations_id = '$locations_id'
            AND id.products_id = '$products_id'
            AND id.flagstate = true
            "
        ));
    }

    /**
     * 
     * REAL PRICE ID
     * El mismo REAL PRICE pero este usa un input_details_id
     * 
     */
    public function real_price_id($locations_id, $input_details_id){
        $inputDetail = InputDetails::find($input_details_id);
        if($inputDetail){
            return $this->real_price($locations_id, $inputDetail->products_id);
        }
    }

    /**
     * Inventario retrocompatible
     */
    public function index($locations_id = false, $show_zeros = false){
        // $res = $this->stockFromInputDetails($locations_id, false, !$show_zeros);
        // $this->insertProducts($res);
        // return $res;
        $location = "";
        if($locations_id){;
            $locations_id = (int)$locations_id;
            $location = "WHERE i.locations_id = '$locations_id'";    
        }
        // minimo para mostrar
        $minToShow = ($show_zeros) ? config('dev.logistic.inventory_mintoshow') : 1;
        $sql = "SELECT
                    s.*
                FROM (
                    SELECT
                        id.id,
                        id.quantity,
                        id.unit_price,
                        id.created_at AS id_last_time,
                        c.value AS p_categorie,
                        p.name AS products_name,
                        p.id AS products_id,
                        SUM(IFNULL(od.quantity, 0)) AS od_total,
                        (id.quantity - SUM(IFNULL(od.quantity, 0))) AS stock,
                        l.name AS locations_name,
                        MAX(IFNULL(od.created_at, '')) AS od_last_time
                    FROM input_details AS id
                    LEFT JOIN products AS p ON p.id = id.products_id
                    LEFT JOIN output_details AS od ON od.input_details_id = id.id
                    LEFT JOIN inputs AS i ON i.id = id.inputs_id
                    LEFT JOIN locations AS l ON l.id = i.locations_id
                    LEFT JOIN categories AS c ON c.id = p.categories_id
                    $location
                    GROUP BY id.id
                ) AS s
                WHERE s.stock >= $minToShow
                ORDER BY s.products_name ASC";
                // dd($sql);
        $res = DB::select($sql);
        $this->insertProducts($res);
        return $res;
    }

    /**
     * Inventario agrupado por producto
     */
    public function indexGrouped($locations_id){
        // $res = $this->inventoryByLocation($locations_id);
        // return $res;
        $location = "";
        if($locations_id){;
            $locations_id = (int)$locations_id;
            $location = "WHERE i.locations_id = '$locations_id'";    
        }

        $sql = "SELECT
                    MAX(s.id) AS id,
                    SUM(s.quantity) AS quantity,
                    MAX(s.unit_price) AS unit_price,
                    MAX(s.created_at) AS id_last_time,
                    s.p_categorie,
                    s.products_name,
                    s.products_id,
                    SUM(s.od_total) AS od_total,
                    -- (id.quantity - SUM(IFNULL(od.quantity, 0))) AS stock,
                    SUM(s.stock) AS stock,
                    s.locations_name,
                    MAX(s.od_last_time) AS od_last_time
                FROM (
                    SELECT
                        id.id,
                        id.quantity,
                        id.unit_price,
                        id.created_at,
                        c.value AS p_categorie,
                        p.name AS products_name,
                        p.id AS products_id,
                        SUM(IFNULL(od.quantity, 0)) AS od_total,
                        (id.quantity - SUM(IFNULL(od.quantity, 0))) AS stock,
                        l.name AS locations_name,
                        MAX(IFNULL(od.created_at, '')) AS od_last_time
                    FROM input_details AS id
                    LEFT JOIN products AS p ON p.id = id.products_id
                    LEFT JOIN output_details AS od ON od.input_details_id = id.id
                    LEFT JOIN inputs AS i ON i.id = id.inputs_id
                    LEFT JOIN locations AS l ON l.id = i.locations_id
                    LEFT JOIN categories AS c ON c.id = p.categories_id
                    $location
                    GROUP BY id.id
                ) AS s
                GROUP BY s.products_id";
        $res = DB::select($sql);
        // dd($res);
        $this->insertProducts($res);
        return $res;
    }





















    /**
     * BASURITA EN PROCESO DE RENOVACION
     */
    


    public function stock_location(Request $request, $locations_id = null){
        return DB::select(DB::raw(
        "SELECT
            p.id AS p_id,
            p.name AS p_name,
            c.value AS p_categorie,
            SUM(IFNULL(s.id_quantity, 0)) AS sum_id_quantity,
            SUM(IFNULL(s.sum_od_quantity, 0)) AS sum_od_quantity,
            SUM(IFNULL(s.id_quantity, 0)) - SUM(IFNULL(s.sum_od_quantity, 0)) AS stock
        FROM products AS p
        LEFT JOIN (
            SELECT
                i.id AS i_id,
                i.locations_id AS i_locations_id,
                i.`type` AS i_type,
                id.id AS id_id,
                id.products_id AS id_products_id,
            --	p.name AS p_name,
                id.quantity AS id_quantity,
            --	o.id AS o_id,
            --	o.locations_id AS o_locations_id,
            --	o.`type` AS o_type,
            --	od.id AS od_id,
            --	od.quantity AS od_quantity
                SUM(od.quantity) AS sum_od_quantity
            FROM inputs AS i
            JOIN input_details AS id ON id.inputs_id = i.id
            JOIN products AS p ON p.id = id.products_id
            LEFT JOIN output_details AS od ON od.input_details_id = id.id
            LEFT JOIN outputs AS o ON o.id = od.outputs_id
            WHERE i.locations_id = '${locations_id}'
            GROUP BY i.id ASC, id.id ASC
        ) AS s ON s.id_products_id = p.id
        JOIN categories AS c ON p.categories_id = c.id
        GROUP BY p.id
        ORDER BY stock DESC"
        ));
    }
    public function stock_location_po($locations_id){
        return DB::select(DB::raw(
        "SELECT
            p.id AS p_id,
            p.name AS p_name,
            c.value AS p_categorie,
            SUM(IFNULL(s.id_quantity, 0)) AS sum_id_quantity,
            SUM(IFNULL(s.sum_od_quantity, 0)) AS sum_od_quantity,
            SUM(IFNULL(s.id_quantity, 0)) - SUM(IFNULL(s.sum_od_quantity, 0)) AS stock,
            po.minimum AS po_minimum,
            po.permanent AS po_permanent,
            po.duration AS po_duration
        FROM products AS p
        LEFT JOIN (
            SELECT
                i.id AS i_id,
                i.locations_id AS i_locations_id,
                i.`type` AS i_type,
                id.id AS id_id,
                id.products_id AS id_products_id,
            --	p.name AS p_name,
                id.quantity AS id_quantity,
            --	o.id AS o_id,
            --	o.locations_id AS o_locations_id,
            --	o.`type` AS o_type,
            --	od.id AS od_id,
            --	od.quantity AS od_quantity
                SUM(od.quantity) AS sum_od_quantity
            FROM inputs AS i
            JOIN input_details AS id ON id.inputs_id = i.id
            JOIN products AS p ON p.id = id.products_id
            LEFT JOIN output_details AS od ON od.input_details_id = id.id
            LEFT JOIN outputs AS o ON o.id = od.outputs_id
            WHERE i.locations_id = '${locations_id}'
            GROUP BY i.id ASC, id.id ASC
        ) AS s ON s.id_products_id = p.id
        JOIN categories AS c ON p.categories_id = c.id
        LEFT JOIN product_options AS po ON po.products_id = p.id
        WHERE IFNULL(po.locations_id, '${locations_id}') = '${locations_id}'
        GROUP BY p.id
        ORDER BY stock DESC"
        ));
    }
    public function stock_status($locations_id){
        return DB::select(DB::raw(
        "SELECT
            p.id AS p_id,
            p.name AS p_name,
            c.value AS p_categorie,
            SUM(IFNULL(s.id_quantity, 0)) AS sum_id_quantity,
            -- SUM(IFNULL(s.id_price_value, 0))/SUM(IFNULL(s.id_quantity, 0)) AS real_price,
            SUM(IFNULL(s.sum_od_quantity, 0)) AS sum_od_quantity,
            SUM(IFNULL(s.id_quantity, 0)) - SUM(IFNULL(s.sum_od_quantity, 0)) AS stock,
            MAX(s.od_updated_at) AS od_updated_at,
            po.minimum AS po_minimum,
            po.permanent AS po_permanent,
            po.duration AS po_duration
        FROM products AS p
        LEFT JOIN (
            SELECT
                i.id AS i_id,
                i.locations_id AS i_locations_id,
                i.`type` AS i_type,
                id.id AS id_id,
                id.products_id AS id_products_id,
            --	p.name AS p_name,
                id.quantity AS id_quantity,
                -- id.unit_price*id.quantity AS id_price_value,
            --	o.id AS o_id,
            --	o.locations_id AS o_locations_id,
            --	o.`type` AS o_type,
            --	od.id AS od_id,
            --	od.quantity AS od_quantity
                MAX(od.updated_at) AS od_updated_at,
                SUM(od.quantity) AS sum_od_quantity
            FROM inputs AS i
            JOIN input_details AS id ON id.inputs_id = i.id
            JOIN products AS p ON p.id = id.products_id
            LEFT JOIN output_details AS od ON od.input_details_id = id.id
            LEFT JOIN outputs AS o ON o.id = od.outputs_id
            WHERE i.locations_id = '${locations_id}'
            GROUP BY i.id ASC, id.id ASC
        ) AS s ON s.id_products_id = p.id
        JOIN categories AS c ON p.categories_id = c.id
        JOIN product_options AS po ON po.products_id = p.id
        WHERE IFNULL(po.locations_id, '${locations_id}') = '${locations_id}'
        GROUP BY p.id
        ORDER BY stock DESC"
        ));
    }
}
