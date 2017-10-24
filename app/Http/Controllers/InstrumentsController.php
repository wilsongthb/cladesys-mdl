<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstrumentsController extends Controller
{
    public function index(){
        $appConfig = [
            // 'name' => 'instruments',
            'appUrl' => url('/instruments'),
            'apiUrl' => url('/rsc'),
            'appName' => 'INSTRUMENTS',
            'baseUrl' => url('/instruments')
        ];
        return view('instruments.index', $appConfig);
    }
}