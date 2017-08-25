<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\ProductOptions;

class ProductOptionsController extends Controller
{
    public function getOrCreate(Request $request, $locations_id, $products_id){
        $fila = ProductOptions::
            where('products_id', $products_id)
            ->where('locations_id', $locations_id)
            ->first();
        if($fila){
            return $fila;
        }else{
            $fila = new ProductOptions;
            // $fila->minimum = $request->minimum;
            // $fila->permanent = $request->permanent;
            // $fila->duration = $request->duration;
            $fila->products_id = $products_id;
            $fila->locations_id = $locations_id;
            // $fila->user_id = $request->user_id;
            $fila->user_id = \Auth::user()->id;
            $fila->save();
            return $fila;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = ($request->per_page) ? $request->per_page : config('logistic.per_page');
        $res = ProductOptions::
            select(
                'po.*',
                'p.id AS products_id',
                'p.name AS products_name',
                'l.name AS locations_name'
            )
            ->from('product_options AS po')
            ->leftJoin('products AS p', 'p.id', '=', 'po.products_id')
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
        //
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
        $fila->user_id = $request->user_id;
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
        //
    }
}
