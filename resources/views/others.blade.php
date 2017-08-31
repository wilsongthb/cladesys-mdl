<!-- Welcome With Material Design Lite -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('/bower_components/material-design-lite/material.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('/bower_components/material-design-icons/iconfont/material-icons.css') }} ">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
</head>

<body>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--4-col"></div>
        <div class="mdl-cell mdl-cell--4-col">
            <h1>{{config('app.name')}} </h1>
        </div>
        <div class="mdl-cell mdl-cell--4-col"></div>
    </div>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--4-col"></div>
        <div class="mdl-cell mdl-cell--4-col">
            <!-- Simple Textfield -->
            <form action="#">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" id="sample1">
                    <label class="mdl-textfield__label" for="sample1">Email</label>
                </div>
            </form>

        </div>
        <div class="mdl-cell mdl-cell--4-col"></div>
    </div>
    
    <script src="{{ asset('/bower_components/material-design-lite/material.min.js') }}"></script>
</body>
</html>