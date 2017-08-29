<?php

namespace App\Http\Controllers\Logistic;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Locations::
            select(
                'l.*',
                DB::raw("COUNT(po.id) AS po_quantity")
            )
            ->from('locations AS l')
            ->leftJoin('product_options AS po', 'po.locations_id', '=', 'l.id')
            ->where('l.flagstate', 1)
            ->groupBy('l.id')
            ->get();
        // return DB::select(DB::raw(
        // "SELECT 
        //     l.*,
        //     COUNT(po.id) AS po_quantity
        // FROM locations AS l
        // LEFT JOIN product_options AS po ON po.locations_id = l.id
        // WHERE l.flagstate = 1
        // GROUP BY l.id
        // "));
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
        $fila = new Locations;
        $fila->user_id = $request->user_id;
        $fila->name = $request->name;
        $fila->type = $request->type;
        $fila->utility = $request->utility;
        $fila->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function show(Locations $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function edit(Locations $locations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locations $locations, $id)
    {
        // dd($locations, $id);
        $fila = Locations::find($id);
        // $fila = $locations;
        $fila->user_id = $request->user_id;
        $fila->name = $request->name;
        $fila->type = $request->type;
        $fila->utility = $request->utility;
        $fila->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locations $locations, $id)
    {
        $fila = Locations::find($id);
        $fila->flagstate = 2;
        $fila->save();
    }
}
