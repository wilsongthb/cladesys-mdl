<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Suppliers;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Suppliers::select(
                'suppliers.*'
            )
            ->where('suppliers.flagstate', '1') // si esta eliminado no lo considera
            ->orderBy('suppliers.id', 'DESC');
        if(strlen($request->search) !== 0){// si se envia algun argumento de busqueda
            // condiciones de busqueda
            $res
                ->where('suppliers.company_name', 'LIKE', "%$request->search%")
                ->orWhere('suppliers.contact_name', 'LIKE', "%$request->search%");
        }
        // enviar el resultado
        return $res->paginate(15);
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
        $fila = new Suppliers;
        // requerido
        $fila->contact_name = $request->contact_name;
        $fila->phone = $request->phone;
        $fila->country = $request->country;
        $fila->region = $request->region;
        $fila->account_number = $request->account_number;
        $fila->bank = $request->bank;
        $fila->user_id = auth()->user()->id;
        // opcional
        $fila->company_name = isset($request->company_name) ? $request->company_name : NULL;
        $fila->identity = isset($request->identity) ? $request->identity : NULL;
        $fila->address = isset($request->address) ? $request->address : NULL;
        $fila->postal_code = isset($request->postal_code) ? $request->postal_code : NULL;
        $fila->home_page = isset($request->home_page) ? $request->home_page : NULL;
        $fila->email = isset($request->email) ? $request->email : NULL;
        $fila->observation = isset($request->observation) ? $request->observation : NULL;
        $fila->products_stock = isset($request->products_stock) ? $request->products_stock : NULL;
        $fila->doc_type = isset($request->doc_type) ? $request->doc_type : NULL;
        // guardar
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
        $registro = Suppliers::find($id);
        if($registro){
            return $registro;
        }else {
            return response()->json(['error' => 'Error, not found'], 404); // Status code here
        }
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
        $fila = Suppliers::find($id);
        // requerido
        $fila->contact_name = $request->contact_name;
        $fila->phone = $request->phone;
        $fila->country = $request->country;
        $fila->region = $request->region;
        $fila->account_number = $request->account_number;
        $fila->bank = $request->bank;
        $fila->user_id = auth()->user()->id;
        // opcional
        $fila->company_name = isset($request->company_name) ? $request->company_name : NULL;
        $fila->identity = isset($request->identity) ? $request->identity : NULL;
        $fila->address = isset($request->address) ? $request->address : NULL;
        $fila->postal_code = isset($request->postal_code) ? $request->postal_code : NULL;
        $fila->home_page = isset($request->home_page) ? $request->home_page : NULL;
        $fila->email = isset($request->email) ? $request->email : NULL;
        $fila->observation = isset($request->observation) ? $request->observation : NULL;
        $fila->products_stock = isset($request->products_stock) ? $request->products_stock : NULL;
        $fila->doc_type = isset($request->doc_type) ? $request->doc_type : NULL;
        // guardar
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
        $registro = Suppliers::find($id);
        $registro->flagstate = 0;
        $registro->save();
    }
}
