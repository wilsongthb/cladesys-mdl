<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de Cotización</title>

    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}} ">
    
</head>
<body>
    <h3 class="text-center">SOLICITUD DE COTIZACION</h3>
    <table class="table small table-striped table-condensed">
        <thead>
            <tr>
                <!-- <th>CODIGO</th> -->
                <th>TIPO</th>
                <th>CANTIDAD</th>
                <th>MEDIDA DE DISTRIBUCION</th>
                <th>PRODUCTO</th>
                <th>MARCA</th>
                <th>PRECIO</th>
                <th class="col-xs-5">OBSERVACION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ord as $fila)
            <tr>
                <!-- <td>{{$fila->id}} </td> -->
                <td>{{$fila->p_categorie}} </td>
                <td>{{$fila->quantity}} </td>
                <td>{{$fila->p_measurement}} </td>
                <td>{{$fila->p_name}} </td>
                <td>{{$fila->p_brand}} </td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Sírvase cotizar la presente lista de productos, así como las observaciones y condiciones para su envio a nuestro despacho: Jr Puno N° 107 Ciudad de Puno, Cel: 950311267</p>
</body>
    <script>
        window.print()
    </script>
</html>

