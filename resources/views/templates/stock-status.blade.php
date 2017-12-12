@extends('templates.layouts.container')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">STOCK DEL @{{Locations.list[Locations.get()].name}} </h3>
        <input type="text" class="form-control" ng-model="buscar">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="6">PRODUCTO</th>
                    <th colspan="2">CONFIGURACION DE STOCK</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Producto</th>
                    <th>Total entradas</th>
                    <th>Total salidas</th>
                    <th>Stock</th>
                    <th>Minimo</th>
                    <th>Permanente</th>
                    <th>Duracion</th>
                    <th>
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="l in StockLocation.list | filter: buscar">
                    <td>
                        <product-row product="l.product"></product-row>
                    </td>
                    <td ng-bind="l.sum_id_quantity"></td>
                    <td ng-bind="l.sum_od_quantity"></td>
                    <td ng-bind="l.stock"></td>
                    <td ng-bind="l.productOption.minimum"></td>
                    <td ng-bind="l.productOption.permanent"></td>
                    <td ng-bind="l.productOption.duration"></td>
                    <td>
                        <span ng-show="l.alerts">
                                <p>Stock minimo: <span ng-bind="l.alerts.minimum ? 'OK' : 'Requiere Comprar'"></span></p>
                                <p>Stock permanente: <span ng-bind="l.alerts.permanent ? 'OK' : 'Requiere Comprar'"></span></p>
                                <p>Duracion: <span ng-bind="l.alerts.duration ? 'OK' : 'Requiere Comprar'"></span></p>
                        </span>
                        <!-- <span class="label label-success" ng-if="!l.comprar && !l.urgente">OK</span> -->
                        <!-- <span class="label label-warning" ng-if="l.comprar || l.urgente">Comprar</span>
                        <span class="label label-danger" ng-if="l.urgente">Urgente</span>
                        <span title="@{{l.od_updated_at}}" class="label label-warning" ng-if="l.days">Ultima salida hace @{{l.days}} dias </span> -->
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop
