<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    
    <link rel="stylesheet" href="{{ asset('/bower_components/normalize-css/normalize.css') }} ">

    {{--  <link rel="stylesheet" href="{{ asset('/node_modules/bootstrap-material-design/dist/css/bootstrap-material-design.min.css') }} ">  --}}
    <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
    
    <link rel="stylesheet" href="{{ asset('/bower_components/mui/packages/cdn/css/mui.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }} ">
    {{--  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">  --}}
    {{--  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css" integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">  --}}
    
    
    
    
    <link rel="stylesheet" href="{{ asset('/responsive-side-menu/static/style.css') }} ">
</head>

<body ng-app="logistic" ng-controller="RootController">
    <div id="sidedrawer" class="mui--no-user-select">
        <div id="sidedrawer-brand" class="mui--appbar-line-height">
            <span class="mui--text-title">{{config('app.name')}} </span>
        </div>
        <div class="mui-divider"></div>
        <ul>
            <li>
                <strong>
                    <a href="{{ $appUrl }}/home " >Principal</a>
                </strong>
            </li>
            @foreach ($modules as $module_name => $module)
            <li>
                <strong>
                    <a href="{{ $appUrl }}/{{ $module_name }} ">{{ $module['title'] }} </a>
                </strong>
            </li>
            @endforeach
            <li>
                <strong>Category 1</strong>
                <ul>
                    <li><a href="#">Item 1</a></li>
                    <li><a href="#">Item 2</a></li>
                    <li><a href="#">Item 3</a></li>
                </ul>
            </li>
            {{--  <li>
                <strong>Category 2</strong>
                <ul>
                    <li><a href="#">Item 1</a></li>
                    <li><a href="#">Item 2</a></li>
                    <li><a href="#">Item 3</a></li>
                </ul>
            </li>
            <li>
                <strong>Category 3</strong>
                <ul>
                    <li><a href="#">Item 1</a></li>
                    <li><a href="#">Item 2</a></li>
                    <li><a href="#">Item 3</a></li>
                </ul>
            </li>  --}}
        </ul>
    </div>
    <header id="header">
        <div class="mui-appbar mui--appbar-line-height">
            <div class="mui-container-fluid">
                <a class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
                <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
                <span class="mui--text-title mui--visible-xs-inline-block mui--visible-sm-inline-block">Brand.io</span>
            </div>
        </div>
    </header>
    <div id="content-wrapper">
        <div class="mui--appbar-height">
        </div>
        <div class="mui-container-fluid">
            {{--  <a href="javascript:void(0)" class="btn btn-raised active"><code>.active</code></a>
            <a href="javascript:void(0)" class="btn btn-raised btn-default">Default</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-primary">Primary</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-success">Success</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-info">Info</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-warning">Warning</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-danger">Danger</a>
            <a href="javascript:void(0)" class="btn btn-raised btn-link">Link</a>
            <br>
            <h1>Brand.io</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sollicitudin volutpat molestie. Nullam id tempor
                nulla. Aenean sit amet urna et elit pharetra consequat. Aliquam fringilla tortor vitae lectus tempor, tempor
                bibendum nunc elementum. Etiam ultrices tristique diam, vitae sodales metus bibendum id. Suspendisse blandit
                ligula eu fringilla pretium. Mauris dictum gravida tortor eu lacinia. Donec purus purus, ornare sit amet
                consectetur sed, dictum sit amet ex. Vivamus sit amet imperdiet tellus. Quisque ultrices risus a massa laoreet,
                vitae tempus sem congue. Maecenas nec eros ut lectus vehicula rutrum. Donec consequat tincidunt arcu non
                faucibus. Duis elementum, ante venenatis lacinia cursus, turpis massa congue magna, sed dapibus felis nibh
                sed tellus. Nam consectetur non nibh vitae sodales. Pellentesque malesuada dolor nec mi volutpat, eget vehicula
                eros ultrices.</p>
            <p>Aenean vehicula tortor a tellus porttitor, id elementum est tincidunt. Etiam varius odio tortor. Praesent vel
                pulvinar sapien. Praesent ac sodales sem. Phasellus id ultrices massa. Sed id erat sit amet magna accumsan
                vulputate eu at quam. Etiam feugiat semper imperdiet. Sed a sem vitae massa condimentum vestibulum. In vehicula,
                quam vel aliquet aliquam, enim elit placerat libero, at pretium nisi lorem in ex. Vestibulum lorem augue,
                semper a efficitur in, dictum vitae libero. Donec velit est, sollicitudin a volutpat quis, iaculis sit amet
                metus. Nulla at ante nec dolor euismod mattis cursus eu nisl.</p>
            <p>Quisque interdum facilisis consectetur. Nam eu purus purus. Curabitur in ligula quam. Nam euismod ligula eu tellus
                pellentesque laoreet. Aliquam erat volutpat. Curabitur eu bibendum velit. Cum sociis natoque penatibus et
                magnis dis parturient montes, nascetur ridiculus mus. Nunc efficitur lorem sit amet quam porta pharetra.
                Cras ultricies pellentesque eros sit amet semper.</p>  --}}
            <ng-view></ng-view>
        </div>
    </div>
    {{--  <footer id="footer">
        <div class="mui-container-fluid">
            <br> Made with ♥ by <a href="https://www.muicss.com">MUI</a>
        </div>
    </footer>  --}}

    <script src="{{ asset('/bower_components/mui/packages/cdn/js/mui.min.js') }} "></script>
    <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }} "></script>
    <script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('/responsive-side-menu/static/script.js') }} "></script>
    
    <!-- <script src="{{ asset('/node_modules/bootstrap-material-design/js/bootstrapMaterialDesign.js') }} "></script> -->

    
    @include('logistic.app')
    
</body>
</html>