<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}} </title>

        <!-- Fonts -->
        {{--  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">  --}}
        <link rel="stylesheet" href="{{ asset('/bower_components/material-design-lite/material.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('/bower_components/material-design-icons/iconfont/material-icons.css') }} ">
        {{--  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">  --}}
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links {
                min-height: 100px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            {{--  @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif  --}}
            <div class="top-right links">
                @if (Auth::check())
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endif
            </div>
            

            <div class="content">
                <div class="title m-b-md">
                    <h1>{{config('app.name')}} </h1>
                </div>
                @if (!Auth::check())
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
                @else
                <div class="links">
                    <a href="{{ url('/logistic') }} ">Logistica</a>
                </div>
                @endif
                <div class="links">
                    <a href="{{ url('/bower_components/gentelella/production/') }} ">Gentelella</a>
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <br>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                    <br>
                    <a href="{{url('/bower_components')}} ">BOWER</a>
                </div>
            </div>

        </div>
        
        <script src="{{ asset('/bower_components/material-design-lite/material.min.js') }}"></script>
    </body>
</html>
