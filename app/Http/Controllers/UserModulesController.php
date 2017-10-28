<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModules;

class UserModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserModules::
            select(
                'um.*'
            )->
            from('user_modules AS um')->
            where('um.user_id', $request->get('user_id'))->
            get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reg = new UserModules;
        $reg->module = $request->get('module');
        $reg->type = $request->get('type') ? $request->get('type') : "";
        $reg->get = $request->get('get') ? $request->get('get') : true;
        $reg->post = $request->get('post') ? $request->get('post') : false;
        $reg->put = $request->get('put') ? $request->get('put') : false;
        $reg->delete = $request->get('delete') ? $request->get('delete') : false;
        $reg->user_id = $request->user_id;
        $reg->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $reg = new UserModules;
        $reg = UserModules::find($id);
        $reg->module = $request->get('module');
        $reg->type = $request->get('type') ? $request->get('type') : "";
        $reg->get = $request->get('get') ? $request->get('get') : true;
        $reg->post = $request->get('post') ? $request->get('post') : false;
        $reg->put = $request->get('put') ? $request->get('put') : false;
        $reg->delete = $request->get('delete') ? $request->get('delete') : false;
        // $reg->user_id = auth()->user()->id;
        $reg->user_id = $request->user_id;
        $reg->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserModules::destroy($id);
    }
}
