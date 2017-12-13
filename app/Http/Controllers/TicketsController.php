<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\TicketDetails;
use DB;

class TicketsController extends Controller
{
    public function TicketsFromLocation($locations_id, $onlyCancelled = false){
        if(request()->get('only-cancelled')){
            $onlyCancelled = true;
        }


        $list = Tickets::
            select(
                't.*',
                'o.locations_id AS o_locations_id',
                DB::raw('SUM(td.real_unit_price * td.quantity) AS total_original'),
                DB::raw('SUM(td.unit_price * td.quantity) AS total'),
                DB::raw('SUM(td.unit_price * td.quantity) - SUM(td.real_unit_price * td.quantity) AS total_utility')
            )
            ->from('tickets AS t')
            ->leftJoin('outputs AS o', 'o.id', 't.table_foreign_id')
            ->leftJoin('ticket_details AS td', 'td.tickets_id', 't.id')
            ->where('t.table_foreign_name', 'outputs')
            ->where('o.locations_id', $locations_id)
            ->groupBy('t.id');

        $total = Tickets::
            select(
                // 't.*',
                // 'o.locations_id AS o_locations_id',
                DB::raw('SUM(td.real_unit_price * td.quantity) AS total_original'),
                DB::raw('SUM(td.unit_price * td.quantity) AS total'),
                DB::raw('SUM(td.unit_price * td.quantity) - SUM(td.real_unit_price * td.quantity) AS total_utility')
            )
            ->from('tickets AS t')
            ->leftJoin('outputs AS o', 'o.id', 't.table_foreign_id')
            ->leftJoin('ticket_details AS td', 'td.tickets_id', 't.id')
            ->where('t.table_foreign_name', 'outputs')
            ->where('o.locations_id', $locations_id);

        $list = $onlyCancelled ? $list->where('t.cancelled', true) : $list;
        $total = $onlyCancelled ? $total->where('t.cancelled', true) : $total;

        return [
            'list' => $list->get(),
            'total' => $total->first()
        ];
    }
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
        $t = Tickets::find($id);
        if(!$t->cancellled){
            TicketDetails::where('tickets_id', $id)->delete();
            Tickets::destroy($id);
            return "ok";
        }
        return $this->lockedResponse('YA ESTA CANCELADO');
    }
}
