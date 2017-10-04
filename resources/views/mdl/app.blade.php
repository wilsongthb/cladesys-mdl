<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{--  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">  --}}
    <link rel="stylesheet" href="{{asset('/bower_components/roboto-fontface/css/roboto/roboto-fontface.css')}} ">
    <link rel="stylesheet" href="{{asset('/bower_components/normalize-css/normalize.css')}} ">
    <link rel="stylesheet" href="{{asset('/bower_components/material-design-lite/material.css')}} ">
    {{--  <link rel="stylesheet" href="{{asset('/bower_components/material-design-icons/iconfont/material-icons.css')}} ">  --}}
    <link rel="stylesheet" href="{{asset('/bower_components/material-design-icons-dist/material-icons.css')}} ">

    @yield('head')

</head>
<body>

    @yield('content')

    <script src="{{asset('/bower_components/material-design-lite/material.js')}} "></script>

    @yield('script')

</body>
</html>