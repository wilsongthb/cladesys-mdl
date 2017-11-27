<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\ProductOptions;

class ProductOptionsController extends Controller
{
    /**
     * Se encarga de devolver una configuracion de todas maneras
     * si la encuentra la retorna
     * si no la encuentra la crea y la retorna
     */
    public function getOrCreate(Request $request, $locations_id, $products_id){
        // unico metodo para crear
        $fila = ProductOptions::
            where('products_id', $products_id)
            ->where('locations_id', $locations_id)
            ->first();
        // if($fila){
        //     return $fila;
        // }else{
        if(!$fila){
            $fila = new ProductOptions;
            // $fila->minimum = $request->minimum;
            // $fila->permanent = $request->permanent;
            // $fila->duration = $request->duration;
            $fila->products_id = $products_id;
            $fila->locations_id = $locations_id;
            // $fila->user_id = auth()->user()->id;
            $fila->user_id = \Auth::user()->id;
            $fila->save();
            
        }
        return $fila;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $this->getPerPage($request);
        $res = ProductOptions::
            select(
                'po.*',
                'p.id AS products_id',
                'p.name AS products_name',
                'l.name AS locations_name',
                // adicionales
                'c.value AS categorie',
                'pa.value AS packing',
                'p.units',
                'm.value AS measurement',
                'p.code'
            )
            ->from('product_options AS po')
            ->leftJoin('products AS p', 'p.id', '=', 'po.products_id')
            ->leftJoin('categories AS c', 'c.id', 'p.categories_id')
            ->leftJoin('packings AS pa', 'pa.id', 'p.packings_id')
            ->rightJoin('measurements AS m', 'm.id', 'p.measurements_id')
            ->leftJoin('locations AS l', 'l.id', '=', 'po.locations_id')
            ->where('p.flagstate', 1)
            ->orderBy('po.id', 'DESC');
        if($request->get('search')){
            $res->where('p.name', 'LIKE', "%$request->search%");
        }
        if($request->get('locations_id')){
            $res->where('po.locations_id', $request->get('locations_id'));
        }

        return $res->paginate($per_page);

        // return DB::select(DB::raw(
        //     "SELECT
        //         po.*,
        //         p.id AS products_id,
        //         p.name
        //     FROM product_options AS po
        //     LEFT JOIN products AS p ON p.id = po.products_id
        //     WHERE p.flagstate = 1
        //     AND po.locations_id = 1
        //     ORDER BY po.id DESC"
        // ));
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
        // return $request->all();
                // unico metodo para crear
        $fila = ProductOptions::
            where('products_id', $request->products_id)
            ->where('locations_id', $request->locations_id)
            ->first();
        if($fila){
            // return $fila;
        }else{
            $fila = new ProductOptions;

            $fila->products_id = $request->products_id;
            $fila->locations_id = $request->locations_id;

            $fila->minimum = $request->minimum;
            $fila->permanent = $request->permanent;
            $fila->duration = $request->duration;
            $fila->user_id = auth()->user()->id;
            // $fila->user_id = \Auth::user()->id;
            $fila->save();
            // return $fila;
        }
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
        $fila = ProductOptions::find($id);
        $fila->minimum = $request->minimum;
        $fila->permanent = $request->permanent;
        $fila->duration = $request->duration;
        // $fila->products_id = $request->products_id;
        // $fila->locations_id = $request->locations_id;
        $fila->user_id = auth()->user()->id;
        $fila->save();
        return $fila;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductOptions::destroy($id);
        return "ok";
    }
}
