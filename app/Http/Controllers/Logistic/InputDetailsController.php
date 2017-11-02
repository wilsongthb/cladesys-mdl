<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InputDetails;
use App\Models\Inputs;
use App\Http\Controllers\Logistic\ProductsController;
use App\Http\Controllers\Logistic\SuppliersController;
use DB;

class InputDetailsController extends Controller
{
    // public function 

    /**
     * Retorna un response de error acerca del registro bloqueado
    * @return Response
    */
    private function lockedResponse()
    {
        return response("locked, Registro bloqueado", 401);
    }

    /**
     * SELECT
     * Select para los input details
     * @return QueryBuilder
     */
    public function select(){
        return InputDetails::
            select(
                'id.*',
                's.company_name AS supplier_company_name',
                's.contact_name AS supplier_contact_name',
                'us.name AS user_name',
                DB::raw('(id.unit_price * id.quantity) AS subtotal')
            )->
            from('input_details AS id')->
            leftJoin('inputs AS i', 'i.id', '=', 'id.inputs_id')->
            leftJoin('suppliers AS s', 's.id', '=', 'id.suppliers_id')->
            leftJoin('users AS us', 'us.id', '=', 'id.user_id');
    }

    /**
     * Loader Relationals
     * Se encarga de cargar objetos provenientes de modelos relacionados a este modelo
     * @param Recive el resltado de un Query Builder
     */
    public function loadRelationals(&$array_result, $loadProducts = true, $loadSuppliers = false){
        foreach ($array_result as $key => &$value) {
            $value->product = $loadProducts ? ProductsController::show($value->products_id) : null;
            $value->supplier = $loadSuppliers ? SuppliersController::show($value->suppliers_id) : null;
        }
    }

    /**
     * Obtener todos los registros relacionados a una entrada
     */
    public function getDetailsFrom($inputs_id)
    {
        $inputDetails = $this->select()->
            where('i.id', $inputs_id)->
            orderBy('id.id', 'DESC')->
            get();

        $this->loadRelationals($inputDetails);
        
        // dd($inputDetails[0]);
        return $inputDetails;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request => 'id' o 'inputs_id'
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // RETRO COMPATIBILIDAD
        $inputs_id = $request->get('inputs_id') ? $request->get('inputs_id') : $request->get('id');
        return $this->getDetailsFrom($inputs_id);
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
        $fila->user_id = auth()->user()->id;

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
        $fila->user_id = auth()->user()->id;

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
        
        return InputDetails::destroy($id);
        // $fila = InputDetails::find($id);
        // $fila->flagstate = false;
        // $fila->save();
        // return "deleted";
    }
}
