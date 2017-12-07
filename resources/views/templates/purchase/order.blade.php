
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ORDEN DE COMPRA</title>

        <!-- Bootstrap CSS -->
        {{--  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">  --}}
        <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="text-center">ORDEN DE COMPRA</h3>
                        <h3>RAZON SOCIAL: DENTOLIFE EIRL</h3>
                        <h3>RUC: 20447828392</h3>
                        <h3>DIRECCION: JR TACNA 121</h3>
                       @if (isset($proveedor->company_name))
                        <h4><strong>Compañia: </strong>{{$proveedor->company_name}}</h4>
                        @endif
                        <h4><strong>Contacto: </strong>{{$proveedor->contact_name}}</h4>
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                				    <th class="col-lg-4">Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($filas as $fila)
                            <tr>
                                <td>{{$fila->p_name}} </td>
                                <td class="text-right">{{(isset($fila->quantity)) ? $fila->quantity : $fila->od_quantity}} </td>
                                <td class="text-right">S/. {{$fila->unit_price}} </td>
                                <td class="text-right">S/. {{((isset($fila->quantity)) ? $fila->quantity : $fila->od_quantity) * $fila->unit_price}} </td>
                            </tr>    
                            @endforeach
                            <tr>
                                <td colspan="3">TOTAL</td>
                                <td>S/. {{$total}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <button class="btn btn-raised btn-success" onclick="imprimir()">Imprimir</button> -->
            </div>
        </div>

        <!-- jQuery -->
        {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  --}}
        <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }} "></script>
        <!-- Bootstrap JavaScript -->
        {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  --}}
        <script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    </body>
</html>
 