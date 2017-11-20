
@extends('templates.layouts.container')


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">INVENTARIO DE @{{Locations.list[Locations.get()].name}} </h3>

        
        <div class="alert">
            <input type="checkbox" ng-model="rsc.agrupar" ng-change="rsc.get()"> Agrupar por productos
        </div>

        <input type="text" class="form-control" ng-model="buscar" placeholder="Buscar...">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Fecha de Ultima Entrada</th>
                    <th>Fecha de Ultima Salida</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="l in rsc.list | filter: buscar">
                    <td>
                        <product-row product="l.product"></product-row>
                    </td>
                    <td ng-bind="l.id_last_time"></td>
                    <td ng-bind="l.od_last_time"></td>
                    <td ng-bind="l.stock"></td>
                    {{--  <td>
                        <a href="" class="btn btn-default" ng-click="html.kardexModal.show(l.product)"><i class="fa fa-bars"></i> </a>
                    </td>  --}}
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop


<!-- <a class="btn btn-primary" data-toggle="modal" href='#kardex-modal'>Trigger modal</a> -->
<div class="modal fade" id="kardex-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Kardex</h4>
            </div>
            <div class="modal-body" ng-if="html.kardexModal.product">
                <kardex-product product="html.kardexModal.product"></kardex-product>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
