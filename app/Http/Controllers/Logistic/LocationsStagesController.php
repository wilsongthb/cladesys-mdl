<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LocationsStages;

class LocationsStagesController extends Controller
{
    public function session(Request $request){
        if($request->get('no_stage')){
            session()->pull('locations_stages_id');
            session()->save();
            // return "nostage";
        }
        if($request->get('locations_stages_id')){
            session(['locations_stages_id' => $request->get('locations_stages_id')]);
            session(['locations_stage' => LocationsStages::find(session()->get('locations_stages_id'))]);
            session()->save();
        }
        $stage = LocationsStages::find(session()->get('locations_stages_id'));
        if($stage){
            return $stage;
        }else{
            return "nostage";
        }
        // return LocationsStages::find(session()->get('locations_stages_id'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = new LocationsStages;
        if(request()->get('locations_id')){
            $res = $res->where('locations_id', request()->get('locations_id'));
        }
        return $res->get();
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
        //
    }
}
