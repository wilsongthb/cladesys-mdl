<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModules;
use Auth;

class MainController extends Controller
{
    public function getModules(Auth $auth){
        $modules = array();
        $user = $auth::user();
        $userModules = UserModules::where('user_id', $user->id)->get();
        if(count($userModules) === 0){
            return config('logistic.modules');
        }else{
            foreach ($userModules as $key => $value) {
                $modules[$value->module] = config('logistic.modules')[$value->module];
            }
            return $modules;
        }
    }
    public function isAjax(Request $request){
        if($request->ajax() OR $request->isJson() OR $request->expectsJson()){
            // dd([
            //     'msj' => 'This Ajax response is not available',
            //     'ajax' => $request->ajax(),
            //     'isJson' => $request->isJson(),
            //     'expectsJson' => $request->expectsJson()
            // ]);
            return response(print_r([
                'msj' => 'This Ajax response is not available',
                'ajax' => $request->ajax(),
                'isJson' => $request->isJson(),
                'expectsJson' => $request->expectsJson()
            ], true), 404)->header('Content-Type', 'text/plain');
        }
    }
    public function index(){

        $logistic_theme = config('dev.user_config.logistic.theme');
        // dd("ya fue", $logistic_theme);
        if($logistic_theme === 'gentelella'){
            // echo "gentelella";
            // dd($this->gentelella());
            return $this->gentelella();
            // return redirect('logistic/gentelella');
        }
        
    }
    public function gentelella(){
        $menu = config('logistic.menu');
        $modules = $this->getModules(new Auth);
        
        $categories = array();
        foreach ($menu['categories'] as $categorie_name => &$categorie) {
            $confirm_modules = array();
            foreach ($categorie['modules'] as $module_name) {
                if(isset($modules[$module_name])){
                    array_push($confirm_modules, $module_name);
                }
            }
            if(count($confirm_modules) === 0){
                $categorie['show'] = false;       
            }else{
                $categorie['show'] = true;
                $categorie['modules'] = $confirm_modules;    
            }
        }
        $this->isAjax(request());
        return view('logistic.gentelella.index', [
            // 'baseUrl' => url('logistic/gentelella').'/', // to angular html5 route mode
            // 'appUrl' => url('logistic/gentelella'),
            'baseUrl' => url('logistic').'/', // to angular html5 route mode
            'appUrl' => url('logistic'),
            'apiUrl' => url('logistic/api'),
            'menu' => $menu,
            'modules' => $modules
        ]);
    }
}
