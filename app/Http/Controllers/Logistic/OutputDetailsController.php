<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OutputDetails;
use App\Models\InputDetails;
use DB;
use App\Models\Outputs;
use App\Http\Controllers\Logistic\InventoryController;

class OutputDetailsController extends Controller
{
    /**
     * SELECT
     */
    public function select(){
        return OutputDetails::
        select(
            'od.*',
            'id.products_id',
            'p.name AS products_name',
            'c.value AS products_categorie',
            DB::raw('(od.unit_price * od.quantity) AS subtotal')
        )
        ->from('output_details AS od')
        ->leftJoin('outputs AS o', 'o.id', '=', 'od.outputs_id')
        ->leftJoin('input_details AS id', 'id.id', '=', 'od.input_details_id')
        ->leftJoin('products AS p', 'p.id', '=', 'id.products_id')
        ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = $this->select()
            ->where('o.id', $request->id)
            ->orderBy('od.id', 'DESC')
            ->get();

        $inv = new InventoryController;
        $inv->insertProducts($res);

        return $res;
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
        $output = Outputs::find($request->outputs_id);

        if($output->status === 2){
            return "locked";
        }

        $inputDetail = InputDetails::find($request->input_details_id);

        $fila = new OutputDetails;
        $fila->utility = isset($request->utility) ? $request->utility : 0;
        $fila->unit_price = ($output->type === 1) ? $inputDetail->unit_price : $request->unit_price;
        // $fila->unit_price = $request->unit_price;
        // $fila->unit_price = isset($request->unit_price) ? $request->unit_price : '';
        // $fila->real_unit_price = 
        $fila->quantity = $request->quantity;
        $fila->input_details_id = $request->input_details_id;
        $fila->outputs_id = $request->outputs_id;
        $fila->user_id = auth()->user()->id;
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
        // return O
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
        $fila = OutputDetails::find($id);
        
        $output = Outputs::find($fila->outputs_id);
        
        if($output->status === 2){
            return "locked";
        }

        // if($output->status === 1){
        //     // $fila->status = $request->status;
        // }
        
        $fila->utility = $request->utility;
        $fila->unit_price = $request->unit_price;
        $fila->quantity = $request->quantity;
        // $fila->input_details_id = $request->input_details_id;
        // $fila->outputs_id = $request->outputs_id;
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
        $fila = OutputDetails::find($id);
        
        $output = Outputs::find($fila->outputs_id);
        
        if($output->status === 2){
            return "locked";
        }

        OutputDetails::destroy($id);
    }
}
