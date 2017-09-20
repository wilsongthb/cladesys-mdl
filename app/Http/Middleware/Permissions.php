<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permissions as DB_Permissions;
use Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // var_dump($request);
        // dd($request->getMethod());
        
        // dd(DB_Permissions::where());
        $method = $request->getMethod();
        $user = Auth::user();

        if($method === "GET"){
            $permiso = DB_Permissions::
                where('user_id', $user->id)
                ->where('permission', 2)
                ->get();
        }elseif($method === "POST"){
            $permiso = DB_Permissions::
                where('user_id', $user->id)
                ->where('permission', 3)
                ->get();
        }elseif($method === "PUT"){
            $permiso = DB_Permissions::
                where('user_id', $user->id)
                ->where('permission', 4)
                ->get();
        }elseif($method === "DELETE"){
            $permiso = DB_Permissions::
                where('user_id', $user->id)
                ->where('permission', 5)
                ->get();
        }

        if(count($permiso) !== 0){
            // dd("bienvenido papu");
            // dd($request);
            // echo "<pre>$request->()</pre>";
            return $next($request);
        }else{
            // dd("no tienes permiso");
            return response('No tienes permiso', 404)
                ->header('Content-Type', 'text/plain');
        }

        // if()

        // if(
        //     $request->getMethod() !== "GET"
        // ) dd("No tienes permiso");
        
        

        
    }
}
