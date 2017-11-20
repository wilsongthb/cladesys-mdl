
@extends('templates.layouts.container')


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">INVENTARIO GENERAL </h3>
        <input type="text" class="form-control" ng-model="buscar">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>UBICACION</th>
                    <th>ID DE ENTRADA</th>
                    <th>Producto</th>
                    <th>Cantidad Ingresada</th>
                    <th>Fecha de Entrada</th>
                    <th>Total salidas</th>
                    <th>Fecha de Ultima Salida</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="l in rsc.list | filter: buscar">
                    <td ng-bind="l.locations_name"></td>
                    <td ng-bind="l.id"></td>
                    <td>
                        <product-row product="l.product"></product-row>
                    </td>
                    <td ng-bind="l.quantity"></td>
                    <td ng-bind="l.id_last_time"></td>
                    <td ng-bind="l.od_total"></td>
                    <td ng-bind="l.od_last_time"></td>
                    <td ng-bind="l.stock"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop
