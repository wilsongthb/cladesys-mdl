@extends('templates.layouts.container')



@section('content')
<div class="form-group">
    <input type="text" ng-model="buscar" class="form-control">
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>PRODUCTO</th>
            <th>VALOR</th>
            <th>STOCK</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="i in StockLocation.list | filter: buscar">
            <td>
                <product-row product="i.product"></product-row>
            </td>
            <td ng-bind="html.moneyFormatter.format('PEN', i.price)"></td>
            <td ng-bind="i.stock"></td>
            <td>
                <div class="btn-group">
                    <a href="" title="Historial" class="btn btn-default" ng-click="html.showHistory(i)"><i class="fa fa-bars"></i> </a>
                    <a href="" title="Kardex" class="btn btn-default" ng-click="html.showKardex(i)"><i class="fa fa-book"></i> </a>
                    <a href="" title="Registrar Uso Final" class="btn btn-default" ng-click="html.registrarUso(i)"><i class="fa fa-sign-out"></i> </a>
                </div>
            </td>
        </tr>
    </tbody>
</table>

@endsection

<!-- <a class="btn btn-primary" data-toggle="modal" href='#kardex-modal'>Trigger modal</a> -->
<div class="modal fade" id="history-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">HISTORIAL DE MOVIMIENTOS DEL PRODUCTO</h4>
            </div>
            <div class="modal-body">
                <product-row product="html.item.product"></product-row>
                <h5>ENTRADAS</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="i in rsc.history.inputs">
                            <td ng-bind="i.quantity"></td>
                            <td ng-bind="html.moneyFormatter.format('PEN', i.unit_price)"></td>
                            <td ng-bind="i.created_at"></td>
                        </tr>
                    </tbody>
                </table>
                <h5>SALIDAS</h5>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Valor</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="o in rsc.history.outputs">
                                <td ng-bind="o.quantity"></td>
                                <td ng-bind="html.moneyFormatter.format('PEN', o.unit_price)"></td>
                                <td ng-bind="o.created_at"></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- <a class="btn btn-primary" data-toggle="modal" href='#kardex-modal'>Trigger modal</a> -->
<div class="modal fade" id="kardex-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">KARDEX DE PRODUCTO</h4>
            </div>
            <div class="modal-body">
                <product-row product="html.item.product"></product-row>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th colspan="2">ENTRADAS</th>
                            <th colspan="2">SALIDAS</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="k in rsc.kardex">
                            <td>
                                <a ng-show="k.type === 'ENTRADA'" href="@{{G.appUrl + '/inputs/edit/' + k.h_id}}" target="blank" ng-bind="k.h_id"></a>
                                <a ng-show="k.type === 'SALIDA'" href="@{{G.appUrl + '/outputs/edit/' + k.h_id}}" target="blank" ng-bind="k.h_id"></a>
                            </td>
                            <td ng-bind="k.datetime"></td>
                            <td class="text-right" ng-bind="k.input_quantity"></td>
                            <td class="text-right" ng-bind="html.moneyFormatter.format('PEN', k.input_price)"></td>
                            <td class="text-right" ng-bind="k.output_quantity"></td>
                            <td class="text-right" ng-bind="html.moneyFormatter.format('PEN', k.output_price)"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- <a class="btn btn-primary" data-toggle="modal" href='#uso-modal'>Trigger modal</a> -->
<div class="modal fade" id="uso-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">REGISTRAR USO FINAL</h4>
            </div>
            <form ng-submit="rsc.usoFinal()">
                <div class="modal-body">
                    <div class="form-group">
                        <product-row product="html.item.product"></product-row>
                    </div>
                    <div class="form-group">
                        <table class="table table-hover">
                            <tr>
                                <th>STOCK</th>
                                <th ng-bind="html.item.stock"></th>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="">Cantidad *</label>
                        <input type="number" ng-model="rsc.reg.quantity" max="@{{html.item.stock}}" class="form-control" ng-disabled="html.item.stock <= 0"
                            required>
                    </div>
                    <div class="alert alert-danger" ng-show="html.item.stock <= 0">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                        <strong>ERROR</strong> No hay existencias, no puede registrar usos
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
