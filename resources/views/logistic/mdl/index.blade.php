<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Material Design Lite</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <base href="{{ url('') }}/logistic/">

    <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
    <!-- <link rel="stylesheet" href="{{ asset('/bower_components/baseguide/dist/css/baseguide.css') }} "> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet" href="{{ asset('/bower_components/material-design-icons/iconfont/material-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('/bower_components/material-design-lite/material.min.css') }} ">
</head>

<body>
    <div ng-app="logistic" ng-controller="RootController" class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

        @include('logistic.mdl.header') 
        @include('logistic.mdl.drawer')

        <main class="mdl-layout__content">
            <ng-view></ng-view>
            @include('logistic.mdl.footer')
        </main>
    </div>

    <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }} "></script>
    <script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('/bower_components/material-design-lite/material.min.js') }} "></script>
    <script src="{{ asset('/bower_components/angular/angular.js') }} "></script>
    <script src="{{ asset('/bower_components/angular-route/angular-route.js') }} "></script>

    <!-- mis scripts -->
    <script src="{{ asset('/js/logistic/app.js') }} "></script>
    <script>
        const G = {
            name: 'logistic',
            url: "{{ url('') }}",
            appUrl: "{{ url('') }}/logistic",
            apiUrl: "{{ url('') }}/logistic/api",
            user: {!! json_encode(Auth::user()) !!},
            console: true,
            config: {!! json_encode(config('logistic')) !!}
        }
    </script>
    <script src="{{ asset('/js/logistic/routes.js') }} "></script>
</body>

</html>