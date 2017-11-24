<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inputs;
use DB;

class InputsController extends Controller
{
    /**
     * Selector de la base de datos
     * 
     * la idea es tener un solo select para user en index y show
     */
    public function select(){
        return Inputs::
            select(
                'i.*',
                'l.name AS locations_name',
                'l_o.name AS outputs_locations_name',
                'us.name AS user_name',
                DB::raw('COUNT(id.id) AS total_details')
            )->
            from('inputs AS i')->
            leftJoin('locations AS l', 'l.id', '=', 'i.locations_id')->
            leftJoin('outputs AS o', 'o.id', 'i.outputs_id')->
            leftJoin('locations AS l_o', 'l_o.id', '=', 'o.locations_id')->
            leftJoin('users AS us', 'us.id', '=', 'i.user_id')->
            leftJoin('input_details AS id', 'i.id', '=', 'id.inputs_id')->
            groupBy('i.id');
    }

    /**
    * @return Array of Inputs
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $this->getPerPage($request);
        $locations_id = $request->locations_id;

        return $this->select()
            ->where('i.locations_id', $locations_id)
            ->orderBy('i.id', 'DESC')
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
        $fila = new Inputs;
        $fila->user_id = auth()->user()->id;
        $fila->locations_id = $request->locations_id;
        $fila->type = $request->type;
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
        // return Inputs::find($id);
        return $this->select()->where('i.id', $id)->first();
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
        $fila = Inputs::find($id);
        // dd($fila);
        if($fila->status === 2){
            return "locked";
        }

        // no se puede reactivar
        // if($fila->status === 1){
        if(isset($request->status)) $fila->status = $request->status;
        if(isset($request->type)) $fila->type = $request->type;
        if(isset($request->observation)) $fila->observation = $request->observation;
        // $fila->status = $request->status;
        // $fila->type = $request->type;
            // return "locked";
        // }
        
        // $fila->observation = $request->observation;
        $fila->user_id = auth()->user()->id;

        $fila->save();
        return "locked";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fila = Inputs::find($id);
        if($fila->status === 2){
            return "locked";
        }
        Inputs::destroy($id);
        // $fila->flagstate = 2;
        // $fila->save();
        // $fila->destroy()
    }
}
