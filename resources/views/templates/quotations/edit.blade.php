
@extends('templates.layouts.container')


@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <h3 class="text-center">COTIZAR</h3>
        <a class="btn btn-success" ng-click="rsc.dialogs.addSuppliers()"><i class="fa fa-plus"></i> Agregar Proveedor</a>
        <a href="@{{config.requerimentUrl + '/' + $routeParams.id}} " class="btn btn-warning"><i class="fa fa-cubes"></i> Requerimiento</a>
        <a href="@{{config.comparisonUrl + '/' + $routeParams.id}} " class="btn btn-warning"><i class="fa fa-cubes"></i> Comparacion</a>
        <hr>
        <input type="text" placeholder="Buscar... " ng-model="rsc.dialogs.buscarDet" class="form-control">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="3">Productos</th>
                    <th>Proveedores</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th ng-repeat="s in det.Suppliers" title="@{{s.id}}" class="text-center">
                        @{{ s.company_name }} @{{ s.contact_name }} <i ng-click="det.removeSupplier(s)" class="fa fa-remove"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in det.list | filter: rsc.dialogs.buscarDet">
                    <td ng-bind="d.id"></td>
                    <td ng-bind="d.p_name"></td>
                    <td ng-bind="d.quantity" class="text-right"></td>
                    <td ng-repeat="s in det.Suppliers" ng-click="det.editQuotation(d.id, s.id)" class="text-right">
                        <input 
                        id="q_@{{d.id}}_@{{s.id}}"
                        ng-show="det.quotations[d.id][s.id].edit"
                        type="text" 
                        class="custom-input" 
                        ng-model="det.quotations[d.id][s.id].unit_price"
                        ng-model-options="{ debounce: 1000 }"
                        ng-change="det.save(det.quotations[d.id][s.id], d.id, s.id)">
                        @{{ !det.quotations[d.id][s.id].edit ? enSoles(det.quotations[d.id][s.id].unit_price) : "" }}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


<!-- <a class="btn btn-primary" data-toggle="modal" href='#addSuppliers'>Trigger modal</a> -->
<div class="modal fade" id="addSuppliers">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Proveedores</h4>
            </div>
            <div class="modal-body">
                <label for="">Selecciona un Proveedor</label>
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Compañia</th>
                            <th>Contacto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="s in Suppliers.list">
                            <td ng-bind="s.company_name"></td>
                            <td ng-bind="s.contact_name"></td>
                            <td>
                                <a href="" class="btn btn-success" ng-click="det.addSupplier(s)"><i class="fa fa-plus"></i> </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary" ng-click="">Agregar</button> -->
            </div>
        </div>
    </div>
</div>
@stop

