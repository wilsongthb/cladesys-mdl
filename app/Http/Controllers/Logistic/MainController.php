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
        // dd($user);
        $userModules = UserModules::where('user_id', $user->id)->get();
        // dd(count($userModules));
        if(count($userModules) === 0){
            return config('logistic.modules');
        }else{
            foreach ($userModules as $key => $value) {
                // dd($value);
                // array_push($modules, config('logistic.modules')[$value->module]);
                $modules[$value->module] = config('logistic.modules')[$value->module];
            }
            // dd($modules);
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
            ], true), 404)
            ->header('Content-Type', 'text/plain');
        }
    }
    public function index(){
        return redirect('logistic/gentelella');
    }
    public function gentelella(){
        $menu = config('logistic.menu');
        $modules = $this->getModules(new Auth);

        $categories = array();
        // menu con categorias
        foreach ($menu['categories'] as $categorie_name => &$categorie) {
            // $categorie_modules = $value['modules'];
            $confirm_modules = array();
            foreach ($categorie['modules'] as $module_name) {
                if(isset($modules[$module_name])){
                    array_push($confirm_modules, $module_name);
                }
            }
            if(count($confirm_modules) === 0){
                $categorie['show'] = false;
                // $categorie = null;
                // array_splice($menu['categories'], $categorie_name);
                // array_diff_key($menu['categories'], [$categorie_name => null]);
                
            }else{
                $categorie['show'] = true;
                $categorie['modules'] = $confirm_modules;    
            }
        }
        // foreach ($menu['categories'] as $key => $value) {
        //     // if()
        //     // if( array_except($menu['categories'], $value);    
        // }
        
        // array_
        // dd($menu['categories']);

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
