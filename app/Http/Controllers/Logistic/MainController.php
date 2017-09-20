<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function isAjax(Request $request){
        if($request->ajax() OR $request->isJson() OR $request->expectsJson()){
            dd([
                'msj' => 'This Ajax response is not available',
                'ajax' => $request->ajax(),
                'isJson' => $request->isJson(),
                'expectsJson' => $request->expectsJson()
            ]);
        }
    }
    public function index(){
        return redirect('logistic/gentelella');
    }
    public function gentelella(){
        $menu = config('logistic.menu');
        $modules = config('logistic.modules');

        $this->isAjax(request());
        return view('logistic.gentelella.index', [
            'baseUrl' => url('logistic/gentelella').'/', // to angular html5 route mode
            'appUrl' => url('logistic/gentelella'),
            'apiUrl' => url('logistic/api'),
            'menu' => $menu,
            'modules' => $modules
        ]);
    }
}

