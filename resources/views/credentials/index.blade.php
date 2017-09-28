
@extends('mdl.app')


@section('content')
<div class="mdl-grid" id="app">
    <div class="dml-cell mdl-cell--4-col">asda</div>
    <div class="dml-cell mdl-cell--4-col mdl-shadow--2dp">
        <div class="mdl-typography--text-center">
            <h1>CREDENCIALES DE USUARIO</h1>
            <p>Mdoulo para administrar los permisos de usuario, el nivel de acceso.</p>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">sda</div>
            <div class="mdl-cell mdl-cell--4-col">asdas</div>
            <div class="mdl-cell mdl-cell--4-col">asda</div>
        </div>
    </div>
    <div class="dml-cell mdl-cell--4-col">sad</div>

    <application></application>
</div>
@stop


@section('script')
<script src="{{asset('/bower_components/vue/dist/vue.min.js')}} "></script>
<script src="{{asset('/js/credentials/app.js')}} "></script>
@stop


<template id="application-template">
    <div>
        <h1>@{{msj}} </h1>
        <div></div>
    </div>
</template>
