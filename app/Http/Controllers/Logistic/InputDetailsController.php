<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InputDetails;
use App\Models\Inputs;
use DB;

class InputDetailsController extends Controller
{
    // public function 

    /**
    * @return Response
    */
    private function lockedResponse(){
        return response("locked, Registro bloqueado", 401);
    }

    /**
     * Obtener todos los registros
     */
    public function getDetailsFrom($inputs_id){
        return InputDetails::
            select(
                'id.*',
                'p.name AS products_name',
                'c.value AS products_categorie',
                's.company_name AS suppliers_company_name',
                DB::raw('(id.unit_price * id.quantity) AS subtotal')
            )
            ->from('input_details AS id')
            ->leftJoin('inputs AS i', 'i.id', '=', 'id.inputs_id')
            ->leftJoin('products AS p', 'p.id', '=', 'id.products_id')
            ->leftJoin('suppliers AS s', 's.id', '=', 'id.suppliers_id')
            ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')
            ->where('i.id', $inputs_id)
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getDetailsFrom($request->id);
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
        $input = Inputs::find($request->inputs_id);
        if($input->status === 2){
            return $this->lockedResponse();
        }

        $fila = new InputDetails;
        // // $fila->expiration = $request->expiration;
        $fila->expiration = ($request->get('expiration')) ? $request->expiration : "";
        $fila->inputs_id = $request->inputs_id;
        $fila->products_id = $request->products_id;
        $fila->quantity = $request->quantity;
        $fila->suppliers_id = $request->suppliers_id;
        $fila->ticket_number = $request->ticket_number;
        $fila->ticket_type = $request->ticket_type;
        $fila->unit_price = $request->unit_price;
        $fila->user_id = $request->user_id;

        $fila->lot = ($request->get('lot')) ? $request->lot : "";
        $fila->fabrication = ($request->get('fabrication')) ? $request->fabrication : "";

        $fila->save();
        return "ok";
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
        $fila = InputDetails::find($id);

        $input = Inputs::find($fila->inputs_id);
        if($input->status === 2){
            return $this->lockedResponse();
        }

        
        $fila->expiration = $request->expiration;
        $fila->inputs_id = $request->inputs_id;
        $fila->products_id = $request->products_id;
        $fila->quantity = $request->quantity;
        $fila->suppliers_id = $request->suppliers_id;
        $fila->ticket_number = $request->ticket_number;
        $fila->ticket_type = $request->ticket_type;
        $fila->unit_price = $request->unit_price;
        $fila->user_id = $request->user_id;

        $fila->lot = ($request->get('lot')) ? $request->lot : "";
        $fila->fabrication = ($request->get('fabrication')) ? $request->fabrication : "";

        $fila->save();
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fila = InputDetails::find($id);

        $input = Inputs::find($fila->inputs_id);
        if($input->status === 2){
            return $this->lockedResponse();
        }
        
        $fila = InputDetails::destroy($id);
        return "deleted";
    }
}
