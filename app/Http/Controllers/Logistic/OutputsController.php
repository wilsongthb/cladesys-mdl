<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Outputs;

class OutputsController extends Controller
{
    public function send($id){
        $fila = Outputs::find($id);
        dd($fila);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = ($request->per_page) ? $request->per_page : config('logistic.per_page');
        return Outputs::
            select(
                'o.*',
                'l.name AS locations_name'
            )->from('outputs AS o')
            ->leftJoin('locations AS l', 'l.id', 'o.locations_id')
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
        $fila = new Outputs;
        $fila->type = $request->type;
        $fila->ticket_number = $request->ticket_number;
        $fila->names = $request->names;
        $fila->doc_type = $request->doc_type;
        $fila->doc_number = $request->doc_number;
        $fila->address = $request->address;
        $fila->ticket_type = $request->ticket_type;
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
        return Outputs::find($id);
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
        $fila = Outputs::find($id);
        if($fila->status === 2){
            return "locked";
        }

        if($fila->status === 1){
            $fila->status = $request->status;
        }

        
        $fila->type = $request->type;
        $fila->ticket_number = $request->ticket_number;
        $fila->names = $request->names;
        $fila->doc_type = $request->doc_type;
        $fila->doc_number = $request->doc_number;
        $fila->address = $request->address;
        $fila->ticket_type = $request->ticket_type;
        $fila->locations_id = $request->locations_id;
        $fila->user_id = $request->user_id;
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
        $fila = Outputs::find($id);
        // dd($fila);
        if($fila->status === 2){
            return "locked";
        }
        Outputs::destroy($id);
    }
}
