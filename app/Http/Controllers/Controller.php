<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPerPage(Request $request){
        return ($request->per_page) ? $request->per_page : config('logistic.client.per_page');
    }

    /**
     * Retorna un mensaje de bloqueado
     */
    public function lockedResponse($msj){
        return response($msj, 401);
    }
}
