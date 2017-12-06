<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\TicketDetails;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->get('table')){
            return Tickets::where('table_foreign_name', request()->get('table'))
                ->where('table_foreign_id', request()->get('id'))->get();
        }
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
        // return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function getTicket($id){
        return [
            'ticket' => Tickets::find($id),
            'details' => TicketDetails::where('tickets_id', $id)->get()
        ];
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->getTicket($id);
        $total = 0;
        $real_price = 0;
        foreach ($data['details'] as $key => $value) {
            $total += $value->unit_price * $value->quantity;
            $real_price += $value->real_unit_price * $value->quantity;
        }
        $data['total'] = $total;
        $data['real_price'] = $real_price;
        $data['utilidad'] = $total - $real_price;
        return view('templates.tickets.edit', $data);
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
        $reg = Tickets::find($id);
        $reg->cancelled = true;
        $reg->save();
        // return $request->all();
        return back()->withInput();
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
