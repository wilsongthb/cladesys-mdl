<?php

namespace App\Http\Controllers\Logistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModules;
use Auth;

class MainController extends Controller
{
    /**
    * Metodo principal
    */
    public function index(){
        $logistic_theme = config('dev.user_config.logistic.theme');

        // dd($logistic_theme);

        if($logistic_theme === 'gentelella'){
            return $this->gentelella();
        }

        if($logistic_theme === 'mui'){
            return $this->mui();
        }
    }
    /** 
     *  Funcion para obtener los modulos disponibles para el usuario
     *
     *  Se encarga de crear un array con todos los modulos a los que
     *  el usuario tiene acceso
     *
     *  @param \App\User $user
     *  @return Array $modules
     */

    public function getModules($user){
        $modules = array();
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

    /**
     * Crea un array con algunos recursos utiles para la SPA en
     * Angular JS
     */
    public function resourcesToView(){
        $modules = $this->getModules(Auth::user());
        return [
            'baseUrl' => url('logistic').'/', // to angular html5 route mode
            'appUrl' => url('logistic'),
            'apiUrl' => url('logistic/api'),
            'modules' => $modules
        ];
    }

    /**
    * Esta funcion es para evitar que la carga de la pagina entre en bucle
    
    * ¿Porque?

    * La razon de este error tiene relacion con la ruta especial para 
    * el SPA de angular, laravel debe de pasarle el resto de la url
    * a angular para que este se encarge del ruteo.

    * El detalle esta en que cuando hacemos una llamada erronea a la url
    * por ajax, este pide una copia de la pagina, esto es completamente 
    * innecesario, es por ello que para evitar un consumo injustificado de
    * recursos por un error en el ruteo nos vuelva a cargar la pagina en 
    * una peticion ajax

    */
    public function isAjax(Request $request){
        if($request->ajax() OR $request->isJson() OR $request->expectsJson()){
            // dd([
            //     'msj' => 'This Ajax response is not available',
            //     'ajax' => $request->ajax(),
            //     'isJson' => $request->isJson(),
            //     'expectsJson' => $request->expectsJson()
            // ]);
            exit(print_r([
                'msj' => 'This Ajax response is not available',
                'ajax' => $request->ajax(),
                'isJson' => $request->isJson(),
                'expectsJson' => $request->expectsJson()
            ], true));
            // return response(print_r([
            //     'msj' => 'This Ajax response is not available',
            //     'ajax' => $request->ajax(),
            //     'isJson' => $request->isJson(),
            //     'expectsJson' => $request->expectsJson()
            // ], true), 404)->header('Content-Type', 'text/plain');
        }
    }

    /**
    * GENTELELLA THEME
    * BOOTSTRAP
    */
    public function gentelella(){
        $menu = config('logistic.menu');
        $resource = $this->resourcesToView();
        $categories = array();
        foreach ($menu['categories'] as $categorie_name => &$categorie) {
            $confirm_modules = array();
            foreach ($categorie['modules'] as $module_name) {
                if(isset($resource['modules'][$module_name])){
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
        $resource['menu'] = $menu;
        
        $this->isAjax(request());
        // dd($resource);

        return view('logistic.gentelella.index', $resource);
    }

    /**
    * MUI THEME
    * BOOTSTRAP
    */
    public function mui(){
        return view('logistic.mui.index', $this->resourcesToView());
    }
}
