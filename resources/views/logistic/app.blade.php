{{--  AQUI SE REGISTRAN LOS ASSETS DE LA APLICACION DE LOGISTICA  --}}
{{--  SE PREPARA LA APLICACION PARA FUNCIONAR SIN NECESIDAD DE UN TEMA POR DEFECTO  --}}
    
    {{--  LOGISTIC BASE URL  --}}
    <base href="{{$baseUrl}}">
    <!-- LOGISTIC LINKS -->
    <link href="{{asset('/css/logistic.css') }} " rel="stylesheet">
    <link href="{{asset('/bower_components/angular-bootstrap/ui-bootstrap-csp.css') }} " rel="stylesheet">
    <link href="{{asset('/bower_components/angular-ui-select/dist/select.css') }} " rel="stylesheet">
    <!-- LOGISTIC SCRIPTS -->
    <script src="{{asset('/js/logistic.vendor.min.js') }}"></script>      
    {{--      
    <script src="{{asset('/bower_components/angular/angular.js') }} "></script>
    <script src="{{asset('/bower_components/angular-route/angular-route.js') }} "></script>
    <script src="{{asset('/bower_components/angular-bootstrap/ui-bootstrap.js') }} "></script>
    <script src="{{asset('/bower_components/angular-bootstrap/ui-bootstrap-tpls.js') }} "></script>
    <script src="{{asset('/bower_components/angular-ui-select/dist/select.js') }} "></script>
    <script src="{{asset('/bower_components/money-formatter/dist/money-formatter.min.js') }} "></script>
    <script src="{{asset('/bower_components/number-format.js/lib/format.min.js') }} "></script>
    <script src="{{asset('/bower_components/moment/min/moment.min.js') }} "></script>
    <script src="{{asset('/bower_components/js-xlsx/dist/cpexcel.js') }} "></script>
    <script src="{{asset('/bower_components/js-xlsx/shim.js') }} "></script>
    <script src="{{asset('/bower_components/js-xlsx/jszip.js') }} "></script>
    <script src="{{asset('/bower_components/js-xlsx/xlsx.js') }} "></script>
    <script src="{{asset('/bower_components/file-saver/FileSaver.js') }} "></script>
    <script src="{{asset('/bower_components/angular-ui-uploader/dist/uploader.js')}} "></script>
    <script src="{{asset('/bower_components/jquery.floatThead/dist/jquery.floatThead.min.js')}} "></script>
    --}}
    <script src="{{asset('/js/lodash.min.js')}}"></script>
    <!-- MIS SCRIPTS -->
    <script>
        setTimeout(function() {
            var $table = $('.table-always-show-header');
            /*
                table ALWAYS SHOW HEAD
            */
            $table.floatThead();
        }, 2000);

        const G = {
            name: 'logistic',
            url: "{{ url('') }}",
            appUrl: "{{ $appUrl }}",
            apiUrl: "{{ $apiUrl }}",
            user: {!! json_encode(Auth::user()) !!},
            console: true,
            config: {!! json_encode(config('logistic.client')) !!},
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    </script>
    <script src="{{asset('/js/logistic/app.js')}} "></script>
    <script src="{{asset('/js/logistic/routes.js')}} "></script>
    
    {{--  Services  --}}
    <script src="{{asset('/js/logistic/services/Services.js')}} "></script>
    {{--  Controladores  --}}
    <script src="{{asset('/js/logistic/controllers/RootController.js')}} "></script>
    <script src="{{asset('/js/logistic/controllers/Controllers.js')}} "></script>
    <script src="{{asset('/js/logistic/controllers/InputsController.js')}} "></script>
    <script src="{{asset('/js/logistic/controllers/OutputsController.js')}} "></script>
    <script src="{{asset('/js/logistic/controllers/StockStatusController.js')}} "></script>

    <script src="{{asset('/js/logistic/controllers/HomeController.js')}} "></script>
    <script src="{{asset('/js/logistic/controllers/ProductsController.js')}} "></script>
    {{--  Componentes  --}}
    <script src="{{asset('/js/logistic/components/Components.js')}} "></script>
    <script src="{{asset('/js/logistic/components/productValues.js')}} "></script>