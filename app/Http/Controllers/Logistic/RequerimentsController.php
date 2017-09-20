<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Requeriments;
use App\Models\RequerimentDetails;
use DB;

class RequerimentsController extends Controller
{
    public function imprimir($id){
        $ord = RequerimentDetails::
            select(
                'ord.*',
                'p.code AS p_code',
                'c.value AS p_categorie',
                'm.value AS p_measurement',
                'p.name AS p_name',
                'b.value AS p_brand'
            )
            ->from('requeriment_details AS ord')
            ->leftJoin('products AS p', 'p.id', '=', 'ord.products_id')
            ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')
            ->leftJoin('measurements AS m', 'm.id', '=', 'p.measurements_id')
            ->leftJoin('brands AS b', 'b.id', '=', 'p.brands_id')
            // ->leftJoin('')
            ->where('ord.requeriments_id', $id)
            ->get();
            // dd($ord[1]);
        return view('templates.requeriments.print', [
            'ord' => $ord
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = ($request->per_page) ? $request->per_page : config('logistic.per_page');
        return Requeriments::
            select(
                'or.*',
                'l.name AS locations_name',
                DB::raw("COUNT(ord.id) AS total_details")
            )
            ->from('requeriments AS or')
            ->leftJoin('requeriment_details AS ord', 'ord.requeriments_id', '=', 'or.id')
            ->leftJoin('locations AS l', 'l.id', '=', 'or.locations_id')
            ->where('or.flagstate', 1)
            ->where('or.locations_id', $request->locations_id)
            ->groupBy('or.id')
            ->paginate($per_page);
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
        $fila = new Requeriments;
        $fila->locations_id = $request->locations_id;
        $fila->user_id = $request->user_id;
        $fila->save();
        return $fila;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Requeriments::destroy($id);
    }
}
