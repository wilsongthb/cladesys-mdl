<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotations;
use App\Models\OrderDetails;
use App\Http\Controllers\Logistic\OrderDetailsController;
use DB;
use App\Models\Suppliers;

class QuotationsController extends Controller
{
    public function purchaseOrder($orders_id, $suppliers_id){
        $q = Quotations::
        select(
            'q.*',
            'p.name AS p_name',
            'ord.quantity AS od_quantity'
        )->from('quotations AS q')
        ->leftJoin('order_details AS ord', 'ord.id', '=', 'q.order_details_id')
        ->leftJoin('orders AS or', 'or.id', '=', 'ord.orders_id')
        ->join('products AS p', 'p.id', '=', 'ord.products_id')
        ->where('or.id', $orders_id)
        ->where('q.suppliers_id', $suppliers_id)
        ->where('q.status', true)
        ->get();
        $s = Suppliers::find($suppliers_id);
        return view('templates.purchase.order', [
            'proveedor' => $s,
            'filas' => $q
        ]);
    }
    public function selectMoreCheap(Request $request){
        // $ord = OrderDetails::
        //     select(
        //         'ord.*'
        //     )->from('order_details AS ord')
        //     ->leftJoin('orders AS or', 'or.id', '=', 'ord.orders_id')
        //     ->where('or.id', $request->id)
        //     ->get();
        // $instOrd = new OrderDetailsController;
        // $ord = $instOrd->index($request);
        // dd($ord);
        // dd();
        // $datos = $this->index($request, new OrderDetailsController);
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        DB::table('quotations AS q')
            ->leftJoin('order_details AS od', 'od.id', '=', 'q.order_details_id')
            ->leftJoin('orders AS o', 'o.id', '=', 'od.orders_id')
            ->where('o.id', $request->id)
            ->update(
                ['q.status' => 0]
            );

        $quotations = Quotations::
        select(
            'od.id AS order_details_id',
            // 'p.detail',
            'od.quantity',
            's.company_name',
            'q.*'
        )
        ->from('quotations AS q')
        ->leftJoin('order_details AS od', 'od.id', '=', 'q.order_details_id')
        ->leftJoin('orders AS o', 'o.id', '=', 'od.orders_id')
        ->leftJoin('suppliers AS s', 's.id', '=', 'q.suppliers_id')
        ->leftJoin('products AS p', 'p.id', '=', 'od.products_id')
        ->where('o.id', $request->id)
        ->get();

        // dd($quotations);
        
        $qs = [];

        foreach($quotations as $key => $val){
            if(!isset($qs[$val->order_details_id])){
                $qs[$val->order_details_id] = [];
                $qs[$val->order_details_id][$val->suppliers_id] = $val;
            }else{
                $qs[$val->order_details_id][$val->suppliers_id] = $val;
            }
        }

        // dd($qs);
        $mins = [];

        foreach ($qs as $key => $value) {
            $min = -1;
            foreach ($value as $ll => $vals) {
                $vals->status = 0;
                // $vals->save();
                if($min === -1){$min = $vals;}
                $min = ($min->unit_price > $vals->unit_price) ? $vals : $min;
            }
            // $mins[] = $min->id;
            $min->status = 1;
            $min->save();
        }
        
        // foreach ($mins as $key => $value) {
            
        // }

        dd($qs);
    }
    public function removeSupplier(Request $request){
        // dd($request->all());
        $orders_id = $request->orders_id;
        $suppliers_id = $request->suppliers_id;
        
        $q = Quotations
            ::select('*')
            ->from('quotations AS q')
            ->leftJoin('order_details AS ord', 'ord.id', '=', 'q.order_details_id')
            ->leftJoin('orders AS or', 'or.id', '=', 'ord.orders_id')
            ->where('or.id', $orders_id)
            ->where('q.suppliers_id', $suppliers_id)
            ->delete();
            // ->get();
        // dd($q);
        // return "Borrado, ok";
        return "ok";
    }
    public function selectSuppliers(Request $request){
        $s = Suppliers::
            select(
                's.*',
                DB::raw('COUNT(q.id) AS count_q')
                // 'q.id AS q_id',
                // 'ord.id AS ord_id',
                // 'or.id AS or_id'
            )->from('suppliers AS s')
            ->rightJoin('quotations AS q', 'q.suppliers_id', '=', 's.id')
            ->leftJoin('order_details AS ord', 'ord.id', '=', 'q.order_details_id')
            ->leftJoin('orders AS or', 'or.id', '=', 'ord.orders_id')
            ->where('or.id', $request->id)
            ->where('q.status', 1)
            ->groupBy('s.id')
            ->get();
        // dd($s);
        return $s;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderDetailsController $od)
    {
        $quotations = Quotations::
            select(
                'q.*'
            )->from('quotations AS q')
            // ->join('suppliers AS s', 's.id', '=', 'q.suppliers_id')
            ->leftJoin('order_details AS od', 'od.id', '=', 'q.order_details_id')
            ->leftJoin('orders AS o', 'o.id', '=', 'od.orders_id')
            ->where('o.id', $request->id)
            ->get();

        $suppliers = DB::
            table('quotations AS q')
            ->select(
                's.*'
            )
            ->join('suppliers AS s', 's.id', '=', 'q.suppliers_id')
            ->leftJoin('order_details AS od', 'od.id', '=', 'q.order_details_id')
            ->leftJoin('orders AS o', 'o.id', '=', 'od.orders_id')
            ->where('o.id', $request->id)
            ->get();

        // dd($suppliers);

        return [
            'order_details' => $od->index($request),
            'quotations' => $quotations,
            'suppliers' => $suppliers
        ];
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
        $fila = new Quotations;
        $fila->user_id = $request->user_id;
        $fila->suppliers_id = $request->suppliers_id;
        $fila->unit_price = $request->unit_price;
        $fila->quantity = $request->quantity;
        // $fila->status = false;
        $fila->order_details_id = $request->order_details_id;
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
        $fila = Quotations::find($id);
        $fila->user_id = $request->user_id;
        // $fila->suppliers_id = $request->suppliers_id;
        $fila->unit_price = $request->unit_price;
        $fila->quantity = $request->quantity;
        $fila->status = $request->status;
        // $fila->order_details_id = $request->order_details_id;
        $fila->save();
        dd($fila);
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
