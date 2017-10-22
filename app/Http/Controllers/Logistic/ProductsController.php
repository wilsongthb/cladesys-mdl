<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ProductOptions;

class ProductsController extends Controller
{
    /**
    * @return App\Models\Products; Query builder
    */
    public function select(){
        $res = Products::
            select(
                'p.*',
                'b.value AS brand',
                'm.value AS measurement',
                'pa.value AS packing',
                'c.value AS categorie'
            )->from('products AS p')
            ->leftJoin('brands AS b', 'b.id', '=', 'p.brands_id')
            ->leftJoin('measurements AS m', 'm.id', '=', 'p.measurements_id')
            ->leftJoin('packings AS pa', 'pa.id', '=', 'p.packings_id')
            ->leftJoin('categories AS c', 'c.id', '=', 'p.categories_id')
            ->where('p.flagstate', 1);// si esta desactivado
        return $res;
    }

    /**
    * @param $query String - Cadena de texto para buscar en la base de datos
    * @return App\Models\Products; Query builder
    */
    public function search($query){
        $res = $this->select();
        if(strlen($query) > 0){// si se envia algun argumento de busqueda
            // condiciones de busqueda
            $res
                ->where('p.name', 'LIKE', "%$query%")
                ->orWhere('p.code', 'LIKE', "%$query%")
                ->orWhere('pa.value', 'LIKE', "%$query%")
                ->orWhere('c.value', 'LIKE', "%$query%")
                ->orWhere('b.value', 'LIKE', "%$query%");
        }
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
        $res = $this->search($request->search);
        $res->orderBy('p.id', 'DESC');
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
        $fila = new Products;
        // required
        $fila->user_id = auth()->user()->id;
        $fila->name = $request->name;
        $fila->code = $request->code;
        $fila->brands_id = $request->brands_id;
        $fila->categories_id = $request->categories_id;
        $fila->packings_id = $request->packings_id;
        $fila->measurements_id = $request->measurements_id;
        //no require
        $fila->image_path = $request->get('image_path') ? $request->get('image_path') : "";
        $fila->level = $request->get('level') ? $request->get('level') : "";
        $fila->units = $request->get('units') ? $request->get('units') : "";

        $fila->save();

        if($request->get('po_minimum') || $request->get('po_permanent') || $request->get('po_duration')){
            $po = new ProductOptions;
            $po->minimum = $request->po_minimum;
            $po->permanent = $request->po_permanent;
            $po->duration = $request->po_duration;
            $po->locations_id = $request->po_locations_id;
            $po->products_id = $fila->id;
            $po->user_id = auth()->user()->id;
            $po->save();
        }

        // save
        
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
        return Products::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $fila = Products::find($id);
        // required
        $fila->user_id = auth()->user()->id;
        $fila->name = $request->name;
        $fila->code = $request->code;
        $fila->brands_id = $request->brands_id;
        $fila->categories_id = $request->categories_id;
        $fila->packings_id = $request->packings_id;
        $fila->measurements_id = $request->measurements_id;
        //no require
        $fila->image_path = $request->get('image_path') ? $request->get('image_path') : "";
        $fila->level = $request->get('level') ? $request->get('level') : "";
        $fila->units = $request->get('units') ? $request->get('units') : "";

        // save
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
        $fila = Products::find($id);
        $fila->flagstate = 2;
        $fila->save();
    }
}

