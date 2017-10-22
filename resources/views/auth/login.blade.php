@extends('mdl.app')


@section('head')

@stop

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--2-col"></div>
    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title"><h3>Identificación</h3> </div>
        <div class="mdl-card__supporting-text">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    <label class="mdl-textfield__label" for="sample3">Email</label>
                </div>
                @if ($errors->has('email'))
                <span style="color: red">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" id="password" type="password" name="password" required>
                    <label class="mdl-textfield__label" for="sample3">Clave</label>
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
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
        </div>
    </div>
    <div class="mdl-cell mdl-cell--2-col"></div>    
</div>
@endsection
