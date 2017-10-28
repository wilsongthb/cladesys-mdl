
@extends('templates.layouts.container')


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">INVENTARIO DE @{{Locations.list[Locations.get()].name}} </h3>

        
        <div class="alert">
            <input type="checkbox" ng-model="rsc.agrupar" ng-change="rsc.get()"> Agrupar por productos
        </div>

        <input type="text" class="form-control" ng-model="buscar">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>UBICACION</th>
                    <th>ID DE ENTRADA</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
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
                    <td ng-bind="l.products_name"></td>
                    <td ng-bind="l.p_categorie"></td>
                    <td ng-bind="l.quantity"></td>
                    <td ng-bind="l.created_at"></td>
                    <td ng-bind="l.od_total"></td>
                    <td ng-bind="l.od_last_time"></td>
                    <td ng-bind="l.stock"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop
