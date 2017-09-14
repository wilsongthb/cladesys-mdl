<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(Request $request){
        if($request->ajax() OR $request->isJson() OR $request->expectsJson()){
            dd([
                'msj' => 'This Ajax response is not available',
                'ajax' => $request->ajax(),
                'isJson' => $request->isJson(),
                'expectsJson' => $request->expectsJson()
            ]);
        }
        return view('logistic.gentelella.index');
    }
}

