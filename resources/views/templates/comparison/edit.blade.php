
@extends('templates.layouts.container')


@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="text-center">COMPARAR PRECIOS</h3>
                <a href="" class="btn btn-raised btn-success" ng-click="det.selectMoreCheap()"><i class="fa fa-cubes"></i> Seleccionar mas barato</a>
                <a href="@{{config.requerimentUrl + '/' + $routeParams.id}} " class="btn btn-raised btn-warning"><i class="fa fa-cubes"></i> Requerimiento</a>
                <a href="@{{config.quotationsUrl + '/' + $routeParams.id}} " class="btn btn-raised btn-warning"><i class="fa fa-cubes"></i> Cotización</a>
                <hr>
                <h4>PRODUCTOS REQUERIDOS</h4>
                <input type="text" ng-model="det.buscar" class="form-control" placeholder="Buscar">
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="3">Productos</th>
                            <th colspan="@{{det.Suppliers.length}} ">Proveedores</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th ng-repeat="s in det.Suppliers" title="@{{s.id}}" class="text-center">
                                <p ng-bind="s.company_name"></p>
                                <p ng-bind="s.contact_name"></p>
                                <i ng-click="det.removeSupplier(s)" class="fa fa-remove"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="d in det.list | filter: det.buscar">
                            <td ng-bind="d.id"></td>
                            <td ng-bind="d.p_name"></td>
                            <td ng-bind="d.quantity" class="text-right"></td>
                            <td ng-repeat="s in det.Suppliers" ng-click="det.quotations[d.id][s.id].edit = true" class="text-right">
                                <input type="checkbox" ng-model="det.quotations[d.id][s.id].status" ng-change="det.save(det.quotations[d.id][s.id])">
                                @{{ enSoles(det.quotations[d.id][s.id].unit_price) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

