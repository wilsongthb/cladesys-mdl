
@extends('mdl.app')


@section('head')
    <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}} ">
@stop


@section('content')
<h1 class="mdl-typography--text-center"><br> </h1> 
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col"></div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
        <h1 class="mdl-typography--text-center">{{config('app.name')}}</h1>
        <!-- <div class="mdl-card__title">
            
        </div> -->
        <!-- <div class="mdl-card__media">
            
        </div> -->
        <div class="mdl-card__supporting-text">
            <div class="mdl-typography--text-center">
                <a href="{{ url('/logistic/home') }} " class="mdl-button mdl-js-button mdl-button--raised">Logistica</a>
                <a href="{{ url('/credentials') }} " class="mdl-button mdl-js-button mdl-button--raised">Credenciales</a>
                <a href="{{ url('/lab') }} " class="mdl-button mdl-js-button mdl-button--raised">Laboratorio</a>
                <a href="{{ url('/instruments') }} " class="mdl-button mdl-js-button mdl-button--raised">Instrumentos</a>
                <hr>
                @if (Auth::check())
                
                <a href="{{ route('logout') }}" 
                    class="mdl-button mdl-js-button mdl-button--raised"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @else
                <a href="{{ url('/register') }} " class="mdl-button mdl-js-button mdl-button--raised">Registrar Nuevo Usuario</a>
                @endif
            </div>
            <div class="mdl-card__actions">
            </div>
        </div>
        
    </div>
    <div class="mdl-cell mdl-cell--4-col"></div>
</div>
@stop
