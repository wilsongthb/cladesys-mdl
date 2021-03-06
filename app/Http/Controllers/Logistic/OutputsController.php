<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Outputs;
use App\Models\OutputDetails;
use App\Models\InputDetails;
use App\Models\Inputs;
use App\Models\Products;
use App\Models\Locations;
use App\Http\Controllers\Logistic\InventoryController;
use App\Http\Controllers\Logistic\OutputDetailsController;
use App\Http\Controllers\Logistic\LocationsStagesController;
use App\Http\Controllers\Logistic\StockController;
use App\Models\Tickets;
use App\Models\TicketDetails;
use Auth;
use Datetime;
use DB;

class OutputsController extends Controller
{
    /**
     * Genera un ticket de venta, el tipo es RECIBO
     */
    public function generateTicket($outputs_id){
        // recolectar datos
        $ticket = new Tickets;
        $output = Outputs::find($outputs_id);
        $location = Locations::find($output->locations_id);
        $location_target = Locations::find($output->target_locations_id);

        //ticket
        $ticket->type = 3;
        $ticket->sender = $location->name;
        $ticket->name = $location_target->name;
        $ticket->table_foreign_name = 'outputs';
        $ticket->table_foreign_id = $outputs_id;
        $ticket->user_id = auth()->user()->id;
        $ticket->foreign_json = json_encode($output);
        $ticket->save();

        $output_details = OutputDetails::where('outputs_id', $outputs_id)->get();
        foreach ($output_details as $key => $value) {
            $id = InputDetails::find($value->input_details_id);
            $p = Products::find($id->products_id);

            // ticket details
            $td = new TicketDetails;
            $td->user_id = auth()->user()->id;
            $td->quantity = $value->quantity;
            $td->description = $p->name;
            $td->unit_price = $value->unit_price;
            $td->real_unit_price = $value->real_unit_price ? $value->real_unit_price : 0;
            $td->utility = $value->utility;
            $td->tickets_id = $ticket->id;
            $td->save();
        }

        return $ticket->id;
    }

    /**
     * Desbloquear salida
     */
    public function toUnlock($outputs_id){
        // if(auth()->user()->id === 1){
            $output = Outputs::find($outputs_id);
            $output->status = true;
    
            if($output->type === 2){
                Inputs::where('outputs_id', $outputs_id)->delete();
            }
            $output->save();
        // }
    }
    /**
     * REESTABLECER PRECIOS
     * Reestablece los precios a los originales
     * @param Int Output_ID
     */
    public function reebootPrices($outputs_id){
        $output_details = OutputDetailsController::select($outputs_id);
        $output = Outputs::find($outputs_id);
        $location = Locations::find($output->locations_id);

        foreach ($output_details as $key => $value) {
            $input_detail = InputDetails::find($value->input_details_id);
            $value->real_unit_price = $input_detail->unit_price;
            $value->unit_price = $input_detail->unit_price;

            // exit(print_r([
            //     'value' => $value,
            //     'utility' => (($input_detail->unit_price / 100) * $value->utility)
            // ], true));

            $value->unit_price = $input_detail->unit_price + (($input_detail->unit_price / 100) * $value->utility);
            $value->save();
        }

        $output->updated_at = new Datetime;
        $output->save();
        return $output_details;
    }

    /**
     * PSEUDO FUNCION DE REEBOOT - PRICES
     * @param Request
     */
    public function reebootPricesReq(Request $request){
        return $this->reebootPrices($request->outputs_id);
    }

    /**
     * FINAL USE REQ
     * el mismo FINAL USE pero recibe como parametro el Request
     */
    public function finalUseReq(Request $request){
        // print_r($request->all());
        return $this->finalUse(
            $request->get('locations_id'),
            $request->get('products_id'),
            $request->get('quantity')
        );
    }

    /**
     * FINAL USE
     */
    public function finalUse($locations_id, $products_id, $quantity = 0){
        // $inventory = new InventoryController;
        // $inputs = $inventory->stockFromInputDetails($locations_id, $products_id);
        $stock = new StockController;
        $inputs = $stock->locationStockByInput($locations_id, $products_id);

        // test
        // $original = $inventory->stockFromInputDetails($locations_id, $products_id);
        $original = $stock->locationStockByInput($locations_id, $products_id);
        $orgQuantity = $quantity;

        // calcula cuanto quitar de cada input_details
        $outputs = [];
        foreach ($inputs as $key => &$value) {
            if($quantity >= $value->stock){
                $temp = [
                    'input_details_id' => $value->id,
                    'quantity' => $value->stock
                ];
                if($temp['quantity'] !== 0){
                    $outputs[] = $temp;
                }
                $quantity = $quantity - $value->stock;
                $value->stock = 0;
            }else{
                $temp = [
                    'input_details_id' => $value->id,
                    'quantity' => $quantity
                ];
                if($temp['quantity'] !== 0){
                    $outputs[] = $temp;
                }
                $value->stock = $value->stock - $quantity;
                $quantity = 0;
                break;
            }
        }

        // exit(print_r([
        //     $quantity,
        //     $inputs,
        //     $outputs
        // ]));

        // guarda el resultado
        $output = null;
        if(count($outputs) > 0){
            $output = new Outputs;
            $output->user_id = auth()->user()->id;
            $output->type = 1;
            $output->locations_id = $locations_id;
            $output->observation = "Generado con finalUse";
            $output->save();
            foreach ($outputs as $key => &$value) {
                $input_detail = InputDetails::find($value['input_details_id']);
                $output_detail = new OutputDetails;
                $output_detail->user_id = auth()->user()->id;
                $output_detail->unit_price = $input_detail->unit_price;
                $output_detail->quantity = $value['quantity'];
                $output_detail->input_details_id = $value['input_details_id'];
                $output_detail->outputs_id = $output->id;
                $output_detail->save();
                $value = $output_detail;
            }
        }
        return "ok";

        // dd(
        //     $orgQuantity,
        //     $quantity,
        //     $original,
        //     $inputs,
        //     $output,
        //     $outputs
        // );
    }
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
     * se encarga de cargar lo basico en un QueryBuilder
     */
    public function select(){
        $res = Outputs
            ::select(
                DB::raw('COUNT(od.id) AS total_details'),
                'o.*',
                'l.name AS locations_name',
                'l_d.name AS target_locations_name',
                'u.name AS user_name'
            )
            ->from('outputs AS o')
            ->leftJoin('locations AS l', 'l.id', 'o.locations_id') // almacen
            ->leftJoin('locations AS l_d', 'l_d.id', 'o.target_locations_id') // destino
            ->leftJoin('output_details AS od', 'o.id', 'od.outputs_id')
            ->leftJoin('users AS u', 'u.id', 'o.user_id');
        // dd($res->toSql());
        return $res;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $this->getPerPage($request);
        $stage = LocationsStagesController::getStage();
        $res = $this->select()
            ->where('o.flagstate', true)
            // ->where(DB::raw('IFNULL(od.flagstate, true)'), true)
            ->where('o.locations_id', $request->locations_id)
            ->leftJoin('input_details AS id', 'id.id', 'od.input_details_id')
            ->leftJoin('inputs AS i', 'i.id', 'id.inputs_id')
            // ->where('o.created_at', '>=', $stage->start)
            // ->where('o.created_at', '<=', $stage->end)
            // ->where('i.created_at', '>=', $stage->start)
            ->where(DB::raw("IFNULL(i.created_at, '$stage->start')"), '>=', $stage->start)
            // ->where('i.created_at', '<=', $stage->end)
            ->where(DB::raw("IFNULL(i.created_at, '$stage->end')"), '<=', $stage->end)
            ->groupBy('o.id')
            ->orderBy('o.id', 'DESC');
        return $res->paginate($per_page);
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
        // return Outputs::find($id);
        return $this->select()
            ->where('o.id', $id)
            ->first();
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
        if($fila->status === 2){
            return "locked";
        }
        Outputs::destroy($id);
    }
}
