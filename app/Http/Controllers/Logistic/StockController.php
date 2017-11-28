<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function inputSumProducts($locations_id){
        $sql = 
        "SELECT
            id.products_id,
            IFNULL(ROUND(SUM(id.quantity * id.unit_price)/SUM(id.quantity), 2), 0) AS price,
            COUNT(id.id) AS total_input_details,
            IFNULL(SUM(id.quantity), 0) AS id_quantity_sum,
            MAX(id.created_at) AS id_last_time
        FROM input_details AS id
        LEFT JOIN inputs AS i ON i.id = id.inputs_id
        WHERE
            id.flagstate = true AND
            i.flagstate = true
        GROUP BY id.products_id";
    }
}
