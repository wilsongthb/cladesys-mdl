<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Http\Controllers\Logistic\InventoryController;
use Auth;
use DateTime;

class OrderDetailsController extends Controller
{
    public function addAllReq(Request $request, InventoryController $inventory){
        $stock_status = $inventory->stock_status($request->locations_id);
        foreach ($stock_status as $key => $value) {
            if($value->po_minimum > (int)$value->stock || $value->po_permanent > (int)$value->stock){
                $resto = $value->po_permanent - (int)$value->stock;
                $fila = new OrderDetails;
                $fila->user_id = Auth::user()->id;
                $fila->quantity = $resto;
                $fila->products_id = $value->p_id;
                $fila->detail = "Requieres Comprar";
                $fila->orders_id = $request->orders_id;
                $fila->save();
            }
            if(
                $value->po_minimum === 0 && 
                $value->po_permanent === 0 && 
                (int)$value->stock === 0)
            {
                $datetime1 = new DateTime();
                $datetime2 = new DateTime($value->od_updated_at);
                $interval = $datetime1->diff($datetime2, true);
                $diff = (int)$interval->format('%a');
                if(((int)$value->po_duration - $diff) < 30){
                    $fila = new OrderDetails;
                    $fila->user_id = Auth::user()->id;
                    $fila->quantity = 1;
                    $fila->products_id = $value->p_id;
                    $quedan = (int)$value->po_duration - $diff;
                    $abs_quedan = $quedan*-1;
                    $quedan = ($quedan < 0) ? "se te paso el tiempo, $abs_quedan dias" : "$quedan dias";
                    $fila->detail = "
                        Duracion: $value->po_duration dias,
                        Usado: hace $diff dias,
                        Tiempo restante: $quedan
                    ";
                    $fila->orders_id = $request->orders_id;
                    $fila->save();
                }

                // var_dump('duration');
                // var_dump([
                //     'products_name' => $value->p_name,
                //     'last_time' => $value->od_updated_at,
                //     'stock' => (int)$value->stock,
                //     'minimum' => $value->po_minimum,
                //     'permanent' => $value->po_permanent,
                //     'duration' => $value->po_duration
                // ]);
            }
        }
        // return "ok";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // $per_page = ($request->per_page) ? $request->per_page : config('logistic.per_page');
        return OrderDetails::
            select(
                'ord.*',
                'p.name AS p_name',
                'c.value AS p_categorie'
            )
            ->from('order_details AS ord')
            ->leftJoin('products AS p', 'p.id', '=', 'ord.products_id')
            ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')
            ->where('orders_id', $request->id)
            ->orderBy('ord.id', 'DESC')
            // ->paginate($per_page);
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fila = new OrderDetails;
        $fila->user_id = $request->user_id;
        $fila->quantity = $request->quantity;
        $fila->products_id = $request->products_id;
        $fila->detail = $request->detail;
        $fila->orders_id = $request->orders_id;
        $fila->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fila = OrderDetails::find($id);
        $fila->user_id = $request->user_id;
        $fila->quantity = $request->quantity;
        $fila->products_id = $request->products_id;
        $fila->detail = $request->detail;
        // $fila->orders_id = $request->orders_id;
        $fila->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderDetails::destroy($id);
    }
}
