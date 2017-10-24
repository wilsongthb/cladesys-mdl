<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InstrumentHistory;

class InstrumentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InstrumentHistory::
            select(
                'ih.*', 
                'cp.names AS clinic_patients_names',
                'p.name AS products_name'
            )->
            from('instrument_history AS ih')->
            join('clinic_patients AS cp', 'cp.id', 'ih.clinic_patients_id')->
            join('products AS p', 'p.id', 'ih.products_id')->
            orderBy('ih.id', 'DESC')->
            paginate($this->getPerPage(request()));
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
        $reg = new InstrumentHistory;
        $reg->clinic_doctors_id = $request->get('clinic_doctors_id') ? $request->get('clinic_doctors_id') : "";
        $reg->clinic_doctors_id_collector = $request->get('clinic_doctors_id_collector') ? $request->get('clinic_doctors_id_collector') : "";
        $reg->clinic_patients_id = $request->get('clinic_patients_id') ? $request->get('clinic_patients_id') : "";
        $reg->products_id = $request->get('products_id') ? $request->get('products_id') : "";
        $reg->charge = $request->get('charge') ? $request->get('charge') : "";
        $reg->deliver = $request->get('deliver') ? $request->get('deliver') : "";
        $reg->observation = $request->get('observation') ? $request->get('observation') : "";
        $reg->status = $request->get('status') ? $request->get('status') : "";
        $reg->quantity = $request->get('quantity') ? $request->get('quantity') : "";

        $reg->user_id = auth()->user()->id;
        $reg->save();
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
