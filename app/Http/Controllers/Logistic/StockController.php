<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use stdClass;
use Datetime;
use App\Http\Controllers\Logistic\LocationsStagesController;
use App\Http\Controllers\Logistic\ProductsController;
use App\Models\ProductOptions;

class StockController extends Controller
{
    /**
     * 
     * Stage
     * 
     * Contiene la configuracion de localizacion y fecha de 
     * inicio y final
     * 
     */
    public $stage;

    /**
     * 
     * Constructor
     * 
     * Se encarga de cargar el locationsStage en la entidad
     * 
     */
    public function __construct(){
        $this->stage = $this->getStage();
    }

    /**
     * 
     * Es encarga de obtener el locationsStage y retornarlo
     * 
     * @return (stClass | LocationsStage)
     * 
     */
    public static function getStage(){
        return LocationsStagesController::getStage();
    }

    /**
     * 
     * Sentencia SQL para seleccionar la lista
     * de entradas del area validas
     * 
     * @param Int $locations_id
     * @param LocationsStage $stage
     * @return String
     * 
     */
    public function sqlInputList($locations_id, $stage = false){
        if(!$stage){
            $stage = $this->getStage();
        }

        $sqlInputsList = 
        "SELECT
            id.*,
            i.paid_out AS i_paid_out
        FROM input_details AS id
        JOIN inputs AS i ON i.id = id.inputs_id
        WHERE
            1 = 1  
            AND id.flagstate = true
            AND i.flagstate = true
            AND i.created_at >= '$stage->start'
            AND i.created_at <= '$stage->end'
            AND i.locations_id = '$locations_id'
        ";
        return $sqlInputsList;
    }

    /**
     * 
     * Sentencia SQL para seleccionar el stock de
     * productos por localizacion agrupado por
     * entradas
     * 
     * @param Int $locations_id
     * @param LocationsStage $stage
     * @return String
     * 
     */
    public function sqlStockByInput($locations_id, $stage = false){
        if(!$stage){
            $stage = $this->getStage();
        }

        $sqlInputsList = $this->sqlInputList($locations_id, $stage);

        $sqlStockByInput = 
        "SELECT
            id.*,
            id.unit_price AS value,
            SUM(IFNULL(od.quantity, 0) * IFNULL(od.unit_price, 0)) AS sum_od_subtotal,
            COUNT(od.id) AS count_od,
            SUM(IFNULL(od.quantity, 0)) AS sum_od_quantity,
            MAX(od.created_at) AS max_od_created_at,
            o.paid_out AS o_paid_out,
            id.quantity - SUM(IFNULL(od.quantity, 0)) AS stock,
            -- SUM(IFNULL(od.quantity * od.unit_price, 0)) - (id.unit_price * SUM(IFNULL(od.quantity, 0))) AS profit
            SUM(IFNULL(od.quantity * od.unit_price, 0)) - (IFNULL(od.real_unit_price, id.unit_price) * SUM(IFNULL(od.quantity, 0))) AS profit
        FROM ($sqlInputsList) AS id
        LEFT JOIN output_details AS od ON od.input_details_id = id.id
        LEFT JOIN outputs AS o ON o.id = od.outputs_id
        WHERE 
            1 = 1
            AND IFNULL(o.flagstate, true) = true
            AND IFNULL(od.flagstate, true) = true
            AND IFNULL(o.locations_id, '$locations_id') = '$locations_id'
            -- AND IFNULL(o.created_at, '$stage->start') >= '$stage->start'
            -- AND IFNULL(o.created_at, '$stage->start') <= '$stage->end'
        GROUP BY id.id
        ";

        return $sqlStockByInput;
    }

    /**
     * 
     * Sentencia SQL para seleccionar la lista
     * de stock por producto
     * 
     * @param Int $locations_id
     * @param LocationsStage $stage
     * @return String
     * 
     */
    public function sqlStockByProduct($locations_id, $stage = false){
        if(!$stage){
            $stage = $this->getStage();
        }

        $sqlStockByInput = $this->sqlStockByInput($locations_id, $stage);

        $sqlStockByProduct = 
        "SELECT
            sbi.products_id,
            SUM(sbi.count_od) AS count_od,
            COUNT(sbi.id) AS count_id,
            ROUND(SUM(sbi.quantity * sbi.unit_price)/SUM(sbi.quantity), 2) AS value,
            MAX(sbi.created_at) AS max_id_created_at,
            MAX(sbi.max_od_created_at) AS max_od_created_at,
            SUM(sbi.quantity) AS sum_id_quantity,
            SUM(sbi.sum_od_quantity) AS sum_od_quantity,
            SUM(sbi.quantity * sbi.unit_price) AS sum_id_subtotal,
            SUM(sbi.sum_od_subtotal) AS sum_od_subtotal,
            SUM(sbi.stock) AS stock,
            SUM(sbi.profit) AS profit
        FROM ($sqlStockByInput) AS sbi
        GROUP BY sbi.products_id
        ";

        return $sqlStockByProduct;
    }

    public function locationResume($locations_id, $stage = false){
        if(!$stage){
            $stage = $this->getStage();
        }

        $sqlStockByProduct = $this->sqlStockByProduct($locations_id);

        $sqlResume = 
        "SELECT
            COUNT(sbp.products_id) AS count_products,
            IFNULL(SUM(sbp.sum_id_quantity), 0) AS sum_id_quantity,
            IFNULL(SUM(sbp.sum_od_quantity), 0) AS sum_od_quantity,
            IFNULL(SUM(sbp.count_id), 0) AS sum_id,
            IFNULL(SUM(sbp.count_od), 0) AS sum_od,
            IFNULL(SUM(sbp.count_id + sbp.count_od), 0) AS sum_details,
            IFNULL(SUM(sbp.sum_id_subtotal), 0) AS sum_id_subtotal,
            IFNULL(SUM(sbp.sum_od_subtotal), 0) AS sum_od_subtotal,
            IFNULL(SUM(sbp.stock), 0) AS stock,
            IFNULL(SUM(sbp.profit), 0) AS profit
        FROM ($sqlStockByProduct) AS sbp
        ";

        return response()->json(DB::select($sqlResume)[0], 200);
    }

    /**
     * El stock por productos
     */
    public function locationStockByProduct($locations_id){
        $res = DB::select($this->sqlStockByProduct($locations_id));
        $p = new ProductsController;
        $p->insertProducts($res);

        // dd($res);
        return $res;
    }

    /**
     * El stock por Entradas
     */
    public function locationStockByInput($locations_id, $products_id = false){
        $query = $this->sqlStockByInput($locations_id);
        if($products_id){
            $query = "SELECT s.* FROM ($query) AS s WHERE s.products_id = '$products_id'";
        }
        
        $res = DB::select($query);
        $p = new ProductsController;
        $p->insertProducts($res);

        // dd($res);
        return $res;
    }

    public function StockStatus($locations_id){
        $list = $this->locationStockByProduct($locations_id);
        foreach ($list as $key => &$value) {
            $productOption = ProductOptions::where('locations_id', $locations_id)
                ->where('products_id', $value->products_id)
                ->first();
            if($productOption){
                $value->productOption = $productOption;
                $alerts = new stdClass;
                $alerts->minimum = $value->stock >= $productOption->minimum;
                $alerts->permanent = $value->stock >= $productOption->permanent;
                
                // POR TIEMPO
                $today = new DateTime();
                $last_id = new DateTime($value->max_id_created_at);
                $last_od = new DateTime($value->max_od_created_at);
                $interval_id = $today->diff($last_id, true);
                $interval_od = $today->diff($last_od, true);
                $diff_id = (int)$interval_id->format('%a');
                $diff_od = (int)$interval_od->format('%a');
                $alerts->daysLastInput = $diff_id;
                $alerts->daysLastOutput = $diff_od;
                $alerts->duration = $diff_id <= $productOption->duration;

                $value->alerts = $alerts;
            }

            // dd(
            //     $value
            // );
        }
        return $list;
    }
}
