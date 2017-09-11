<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LOGISTICA</title>

    <!-- Bootstrap -->
    <link href="{{ asset('/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }} " rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('/bower_components/gentelella/vendors/nprogress/nprogress.css') }} " rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('/bower_components/gentelella/vendors/iCheck/skins/flat/green.css') }} " rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('/bower_components/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }} "
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('/bower_components/gentelella/vendors/jqvmap/dist/jqvmap.min.css') }} " rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('/bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }} " rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('/bower_components/gentelella/build/css/custom.min.css') }} " rel="stylesheet">

    <!-- LOGISTIC -->
    <style>
        .btn {
            margin-bottom: 0px;
        }
        .custom-input {
            width: 60px;
        }
    </style>
    <link href="{{ asset('/bower_components/angular-bootstrap/ui-bootstrap-csp.css') }} " rel="stylesheet">
    <link href="{{ asset('/bower_components/angular-ui-select/dist/select.css') }} " rel="stylesheet">
    <base href="{{ url('') }}/logistic/">
</head>

<body class="nav-md">

    <div class="container body" ng-app="logistic" ng-controller="RootController">
        <div class="main_container">
            @include('logistic.gentelella.navbar')

            @include('logistic.gentelella.topnav')

            <!-- page content -->
            <div class="right_col" role="main">
                <ng-view></ng-view>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <p>Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a></p>
                </div>
                <div class="clearfix">
                    <p>LOCALIZACION: @{{Locations.list[Locations.get()].name}} </p>
                </div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('/bower_components/gentelella/vendors/jquery/dist/jquery.min.js') }} "></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <!-- FastClick -->
    <script src="{{ asset('/bower_components/gentelella/vendors/fastclick/lib/fastclick.js') }} "></script>
    <!-- NProgress -->
    <script src="{{ asset('/bower_components/gentelella/vendors/nprogress/nprogress.js') }} "></script>
    <!-- Chart.js -->
    <script src="{{ asset('/bower_components/gentelella/vendors/Chart.js/dist/Chart.min.js') }} "></script>
    <!-- gauge.js -->
    <script src="{{ asset('/bower_components/gentelella/vendors/gauge.js/dist/gauge.min.js') }} "></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('/bower_components/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }} "></script>
    <!-- iCheck -->
    <script src="{{ asset('/bower_components/gentelella/vendors/iCheck/icheck.min.js') }} "></script>
    <!-- Skycons -->
    <script src="{{ asset('/bower_components/gentelella/vendors/skycons/skycons.js') }} "></script>
    <!-- Flot -->
    <script src="{{ asset('/bower_components/gentelella/vendors/Flot/jquery.flot.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/Flot/jquery.flot.pie.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/Flot/jquery.flot.time.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/Flot/jquery.flot.stack.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/Flot/jquery.flot.resize.js') }} "></script>
    <!-- Flot plugins -->
    <script src="{{ asset('/bower_components/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/flot.curvedlines/curvedLines.js') }} "></script>
    <!-- DateJS -->
    <script src="{{ asset('/bower_components/gentelella/vendors/DateJS/build/date.js') }} "></script>
    <!-- JQVMap -->
    <script src="{{ asset('/bower_components/gentelella/vendors/jqvmap/dist/jquery.vmap.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }} "></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('/bower_components/gentelella/vendors/moment/min/moment.min.js') }} "></script>
    <script src="{{ asset('/bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }} "></script>
    <!-- Custom Theme Scripts -->
    {{--  <script src="{{ asset('/bower_components/gentelella/build/js/custom.min.js') }} "></script>  --}}
    <script src="{{ asset('/bower_components/gentelella/src/js/helpers/smartresize.js') }} "></script>

    <!-- LOGISTIC -->
    <script src="{{ asset('/js/logistic/custom.js') }} "></script>
    <script src="{{ asset('/bower_components/angular/angular.js') }} "></script>
    <script src="{{ asset('/bower_components/angular-route/angular-route.js') }} "></script>
    <script src="{{ asset('/bower_components/angular-bootstrap/ui-bootstrap.js') }} "></script>
    <script src="{{ asset('/bower_components/angular-bootstrap/ui-bootstrap-tpls.js') }} "></script>
    <script src="{{ asset('/bower_components/angular-ui-select/dist/select.js') }} "></script>
    <script src="{{ asset('/bower_components/money-formatter/dist/money-formatter.min.js') }} "></script>
    <script src="{{ asset('/bower_components/number-format.js/lib/format.min.js') }} "></script>
    <script src="{{ asset('/bower_components/moment/min/moment.min.js') }} "></script>
    <script src="{{ asset('/bower_components/js-xlsx/dist/cpexcel.js') }} "></script>
    <script src="{{ asset('/bower_components/js-xlsx/shim.js') }} "></script>
    <script src="{{ asset('/bower_components/js-xlsx/jszip.js') }} "></script>
    <script src="{{ asset('/bower_components/js-xlsx/xlsx.js') }} "></script>
    <script src="{{ asset('/bower_components/file-saver/FileSaver.js') }} "></script>
    <!-- mis scripts -->
    <script>
        const G = {
            name: 'logistic',
            url: "{{ url('') }}",
            appUrl: "{{ url('') }}/logistic",
            apiUrl: "{{ url('') }}/logistic/api",
            user: {!!json_encode(Auth::user()) !!},
            console: true,
            config: {!!json_encode(config('logistic')) !!}
        }
    </script>
    <script src="{{ asset('/js/logistic/app.js') }} "></script>
    <script src="{{ asset('/js/logistic/routes.js') }} "></script>
    {{--  Services  --}}
    <script src="{{ asset('/js/logistic/services/Services.js') }} "></script>
    {{--  contoladores  --}}
    <script src="{{ asset('/js/logistic/controllers/Controllers.js') }} "></script>
    <script src="{{ asset('/js/logistic/controllers/HomeController.js') }} "></script>
    <script src="{{ asset('/js/logistic/controllers/ProductsController.js') }} "></script>
    {{--  Componentes  --}}
    <script src="{{ asset('/js/logistic/components/Components.js') }} "></script>
    <script src="{{ asset('/js/logistic/components/productValues.js') }} "></script>
</body>

</html>
