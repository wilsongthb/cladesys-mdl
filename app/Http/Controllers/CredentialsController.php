<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    public function index(){
        return view('credentials.index', [
            'appName' => 'CREDENTIALS',
            'apiUrl' => url('rsc'),
            'appUrl' => url('credentials'),
            'baseUrl' => url('credentials')
        ]);
    }
}
