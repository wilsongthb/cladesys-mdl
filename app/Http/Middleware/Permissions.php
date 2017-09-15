<?php

namespace App\Http\Middleware;

use Closure;

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

        // if(
        //     $request->getMethod() !== "GET"
        // ) dd("Ya fuiste cholo");
        
        

        return $next($request);
    }
}
