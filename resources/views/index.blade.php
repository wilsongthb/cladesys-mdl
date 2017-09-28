
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
            {{--  @if (!Auth::check())
            <h4>Iniciar Sesión</h4>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <p>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input 
                        class="mdl-textfield__input" 
                        type="email" 
                        id="email"
                        name="email"
                        value="{{ old('email') }}" 
                        required 
                        autofocus>
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                </p>
                <p>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input 
                        class="mdl-textfield__input" 
                        type="password" 
                        id="password"
                        name="password"
                        required>
                        <label class="mdl-textfield__label" for="password">Contraseña</label>
                    </div>
                </p>
                <p>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                </p>
                <p>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
                        Ingresar
                    </button>
                </p>
                <p>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Olvidaste tu contraseña
                    </a>
                </p>
            </form>
            @else  --}}
            <div class="mdl-typography--text-center">
                <a href="{{ url('/logistic/home') }} " class="mdl-button mdl-js-button mdl-button--raised">Logistica</a>

                @if (Auth::check())
                <hr>
                <a href="{{ route('logout') }}" 
                    class="mdl-button mdl-js-button mdl-button--raised"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endif
            </div>
            {{--  @endif  --}}
            <div class="mdl-card__actions">
            </div>
        </div>
        
    </div>
    <div class="mdl-cell mdl-cell--4-col"></div>
</div>
@stop
