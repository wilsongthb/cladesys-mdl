<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class InventoryController extends Controller
{
    public function index(Request $request){
        $location = "";
        if($request->locations_id){
            $location = "WHERE i.locations_id = 1";
        }
        $product = "";
        if($request->search && strlen($request->search) !== 0){
            if(strlen($location) === 0){
                $product .= "WHERE";
            }else{
                $product .= "AND";
            }   
            $product .= " p.name LIKE '%$request->search%'";
        }

        $sql = "SELECT
            s.*
        FROM (
            SELECT
                id.*,
                p.name AS products_name,
                SUM(IFNULL(od.quantity, 0)) AS od_total,
                (id.quantity - SUM(IFNULL(od.quantity, 0))) AS stock,
                l.name AS locations_name,
                MAX(IFNULL(od.created_at, '')) AS od_last_time
            FROM input_details AS id
            LEFT JOIN products AS p ON p.id = id.products_id
            LEFT JOIN output_details AS od ON od.input_details_id = id.id
            LEFT JOIN inputs AS i ON i.id = id.inputs_id
            LEFT JOIN locations AS l ON l.id = i.locations_id
            $location
            $product
            GROUP BY id.id
        ) AS s
        WHERE s.stock > 0";

        return DB::select(DB::raw($sql));
    }
}