<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Outputs;
use App\Models\OutputDetails;
use App\Models\InputDetails;
use App\Models\Inputs;
use Auth;

class OutputsController extends Controller
{
    /**
     * SEND
     * 
     * Funcion para enviar una salida de distribucion como
     * una entrada en otro almacen
     * @param: id
     * El id de la localizacion a donde enviar
     */

    public function send($id){
        $output = Outputs::find($id);
        $output_details = OutputDetails::select('*')->where('outputs_id', $id)->get();

        $input = new Inputs;
        $input->locations_id = $output->target_locations_id;
        $input->user_id = Auth::user()->id;
        $input->observation = "ENTRADA DE DISTRIBUCION";
        $input->type = 2;
        $input->status = 2; // BLOQUEADO
        $input->outputs_id = $output->id;
        $input->save();

        foreach ($output_details as $key => $output_detail) {
            // dd($value);
            $origin_input_detail = InputDetails::find($output_detail->input_details_id);
            $input_detail = new InputDetails;
            $input_detail->user_id = Auth::user()->id;
            $input_detail->unit_price = $output_detail->unit_price;
            $input_detail->quantity = $output_detail->quantity;
            $input_detail->inputs_id = $input->id;

            $input_detail->expiration = $origin_input_detail->expiration;
            $input_detail->ticket_number = $origin_input_detail->ticket_number;
            $input_detail->ticket_type = $origin_input_detail->ticket_type;
            $input_detail->suppliers_id = $origin_input_detail->suppliers_id;
            $input_detail->products_id = $origin_input_detail->products_id;
            $input_detail->fabrication = $origin_input_detail->fabrication;
            $input_detail->lot = $origin_input_detail->lot;
            $input_detail->save();

            // var_dump($input_detail);
        }

        $output->status = 2;
        $output->save();
        return "ok";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $this->getPerPage($request);
        return Outputs::
            select(
                'o.*',
                'l.name AS locations_name',
                'l_d.name AS target_locations_id'
            )->from('outputs AS o')
            ->leftJoin('locations AS l', 'l.id', 'o.locations_id') // almacen
            ->leftJoin('locations AS l_d', 'l_d.id', 'o.target_locations_id') // destino
            ->where('o.locations_id', $request->locations_id)
            ->orderBy('o.id', 'DESC')
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
        $fila->target_locations_id = $request->target_locations_id;
        $fila->user_id = auth()->user()->id;
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
        $fila->target_locations_id = $request->target_locations_id;
        $fila->user_id = auth()->user()->id;
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
