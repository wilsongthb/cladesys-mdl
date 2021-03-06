<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequerimentDetails;
use App\Http\Controllers\Logistic\InventoryController;
use Auth;
use DateTime;
use DB;

class RequerimentDetailsController extends Controller
{
    public function deleteList(){
        // print_r(request()->all());
        $list = request()->all();
        
        $out = DB::table('requeriment_details')
            ->whereIn('id', $list)
            ->delete();
            // ->toSql();
        
        // return [$list, $out];
    }
    public function addAllReq(Request $request, InventoryController $inventory){
        $stock_status = $inventory->stock_status($request->locations_id);
        foreach ($stock_status as $key => $value) {
            $stockByPackage = (int)((int)$value->stock * $value->p_units);
            if($value->po_minimum > $stockByPackage || $value->po_permanent > $stockByPackage){
                // $resto = $value->po_permanent - (int)$value->stock;
                $resto = $value->po_permanent - $stockByPackage;
                $fila = new RequerimentDetails;
                $fila->user_id = Auth::user()->id;
                $fila->quantity = $resto;
                $fila->products_id = $value->p_id;
                $fila->detail = "Requieres comprar " . $fila->quantity . " paquetes";
                $fila->requeriments_id = $request->requeriments_id;
                $fila->save();
            }

            // /** para requerir por duracion */
            // if(
            //     $value->po_minimum === 0 && 
            //     $value->po_permanent === 0 && 
            //     (int)$value->stock === 0
            // ){
            //     $datetime1 = new DateTime();
            //     $datetime2 = new DateTime($value->od_updated_at);
            //     $interval = $datetime1->diff($datetime2, true);
            //     $diff = (int)$interval->format('%a');
            //     if(((int)$value->po_duration - $diff) < 30){
            //         $fila = new RequerimentDetails;
            //         $fila->user_id = Auth::user()->id;
            //         $fila->quantity = 1;
            //         $fila->products_id = $value->p_id;
            //         $quedan = (int)$value->po_duration - $diff;
            //         $abs_quedan = $quedan*-1;
            //         $quedan = ($quedan < 0) ? "se te paso el tiempo, $abs_quedan dias" : "$quedan dias";
            //         $fila->detail = "
            //             Duracion: $value->po_duration dias,
            //             Usado: hace $diff dias,
            //             Tiempo restante: $quedan
            //         ";
            //         $fila->requeriments_id = $request->requeriments_id;
            //         $fila->save();
            //     }

            //     // var_dump('duration');
            //     // var_dump([
            //     //     'products_name' => $value->p_name,
            //     //     'last_time' => $value->od_updated_at,
            //     //     'stock' => (int)$value->stock,
            //     //     'minimum' => $value->po_minimum,
            //     //     'permanent' => $value->po_permanent,
            //     //     'duration' => $value->po_duration
            //     // ]);
            // }
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
        
        $per_page = $this->getPerPage($request);
        return DB::table('requeriment_details AS ord')
            ->select(
                'ord.*',
                'p.name AS p_name',
                'c.value AS p_categorie'
            )
            // ->from('requeriment_details AS ord')
            ->leftJoin('products AS p', 'p.id', '=', 'ord.products_id')
            ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')
            ->where('requeriments_id', $request->id)
            ->where('ord.flagstate', 1)
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
        $fila = new RequerimentDetails;
        $fila->user_id = auth()->user()->id;
        $fila->quantity = $request->quantity;
        $fila->products_id = $request->products_id;
        $fila->detail = $request->detail;
        $fila->requeriments_id = $request->requeriments_id;
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
        $fila = RequerimentDetails::find($id);
        $fila->user_id = auth()->user()->id;
        $fila->quantity = $request->quantity;
        $fila->products_id = $request->products_id;
        $fila->detail = $request->detail;
        // $fila->requeriments_id = $request->requeriments_id;
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
        RequerimentDetails::destroy($id);
    }
}
