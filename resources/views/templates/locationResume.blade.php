@extends('templates.layouts.container')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="text-center">RESUMEN DE MOVIMIENTOS - @{{Locations.list[Locations.get()].name}} </h1>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_id_quantity"></div>
                        <h3 class="panel-title">Productos Ingresados</h3>
                    </div>
                    <div class="panel-body">
                        Se refiere a la cantidad de productos ingresados.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_od_quantity"></div>
                        <h3 class="panel-title">Productos Extraidos</h3>
                    </div>
                    <div class="panel-body">
                        Se refiere a la cantidad de productos que se han usado, distribuido o vendido en el almacen.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.count_products"></div>
                        <h3 class="panel-title">Productos</h3>
                    </div>
                    <div class="panel-body">
                        Se considera los productos activos a aquellos de los cuales se tiene registro de movimientos de entrada.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.stock"></div>
                        <h3 class="panel-title">Stock</h3>
                    </div>
                    <div class="panel-body">
                        Cantidad total de productos.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_id"></div>
                        <h3 class="panel-title">Registros de Entrada</h3>
                    </div>
                    <div class="panel-body">
                        Se refiere al numero de registros de entrada.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_od"></div>
                        <h3 class="panel-title">Registros de Salida</h3>
                    </div>
                    <div class="panel-body">
                        Se refiere al numero de registros de salida.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_details"></div>
                        <h3 class="panel-title">Registros</h3>
                    </div>
                    <div class="panel-body">
                        Se refiere al numero total de registros de entrada y salida.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.sum_id_subtotal)"></div>
                        <h3 class="panel-title">Valor Productos Ingresados</h3>
                    </div>
                    <div class="panel-body">
                        El valor de productos ingresados, resultado de la suma total de la multiplicacion del precio unitario y la cantidad de cada uno de los registros de entrada.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.sum_od_subtotal)"></div>
                        <h3 class="panel-title">Valor Productos Extraidos</h3>
                    </div>
                    <div class="panel-body">
                        El valor de productos extraidos, resultado de la suma total de la multiplicacion del precio unitario y la cantidad de cada uno de los registros de salida.
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.profit)"></div>
                        <h3 class="panel-title">Ganancias</h3>
                    </div>
                    <div class="panel-body">
                        El calculo de las ganancias son el resultado de la resta del precio de venta con el precio real.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection