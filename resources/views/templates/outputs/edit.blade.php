
@extends('templates.layouts.container')

@section('content')
<h3 class="text-center">EDITAR SALIDA</h3>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
        <a href="" class="btn btn-default" ng-click="det.reestablecerPrecios()"><i class="fa fa-default"></i> Reestablecer Precios</a>
        <a ng-if="rsc.fila.status !== 1" href="" class="btn btn-default" ng-click="rsc.desbloquear()"><i class="fa fa-unlock"></i> Desbloquear</a>
        <!-- <a href="" class="btn btn-default" ng-click="rsc.desbloquear()"><i class="fa fa-unlock"></i> Desbloquear</a> -->
    </div>
</div>

<div class="row" ng-if="rsc.fila.status === 1">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form ng-submit="det.save()">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="">Producto *</label>
                        <p ng-show="det.fila.id" class="form-control" disabled>
                            <span class="badge" ng-bind="det.fila.stock"></span>
                            <span class="label label-success" ng-bind="det.enSoles(det.fila.unit_price)"></span>
                            <span ng-bind="det.fila.products_name"></span>
                        </p>
                        <ui-select 
                            ng-model="det.fila.input_details_id"
                            on-select="det.getRealPriceId($item)">
                            <ui-select-match  ng-show="!det.fila.id"
                                placeholder="Escribe para buscar">
                                [@{{$select.selected.stock}}] [@{{det.enSoles($select.selected.unit_price)}}] @{{$select.selected.product.name}}
                            </ui-select-match>
                            <ui-select-choices
                                repeat="i.id as i in Inventory.list | filter : $select.search">
                                <span class="badge" title="Stock" ng-bind="'Stock: ' + i.stock"></span>
                                <span class="label label-danger" title="Valor" ng-bind="'Valor: ' + det.enSoles(i.unit_price)"></span>
                                <product-row product="i.product"></product-row>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Cantidad *</label>
                        <input 
                            type="number" 
                            ng-model="det.fila.quantity" 
                            class="form-control" 
                            min="0"
                            max="@{{det.fila.stock}}"
                            required>
                    </div>
                </div>
                <div ng-if="rsc.fila.type !== 1">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Utilidad *</label>
                            <input type="checkbox" ng-model="det.recalcularPrecio"> Autorecalcular
                            <input type="text" ng-model="det.fila.utility" required class="form-control" ng-change="det.calculateUnitPrice()">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Precio Unitario *</label>
                            <div class="input-group">
                                <input type="text" ng-model="det.fila.unit_price" class="form-control" ng-change="det.calculateUnitPrice()" ng-model-options="{ debounce: 1000 }" required>
                                <div class="input-group-addon">@{{det.enSoles(det.fila.unit_price)}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="">ID</label>
                        <p class="form-control" disabled ng-bind="det.fila.id"></p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="">&nbsp;</label>
                        <button type="submit" class="form-control btn btn-raised btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <input type="text" class="form-control" ng-model="buscar" placeholder="Buscar...">
        </div>
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <!-- <th>PROVEEDOR</th>
                    <th>TIPO TICKET</th>
                    <th>NUMERO TICKET</th> -->
                    <th>SUBTOTTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="id in det.list | filter: buscar">
                    <td ng-bind="id.id"></td>
                    <td>
                        <product-row product="id.product"></product-row>
                    </td>
                    <td ng-bind="id.quantity"></td>
                    <td class="text-right" ng-bind="det.enSoles(id.unit_price)"></td>
                    <td class="text-right" ng-bind="det.enSoles(id.subtotal)"></td>
                    <td ng-if="rsc.fila.status === 1">
                        <a href="" class="btn btn-default" ng-click="det.delete(id.id)"><i title="Eliminar" class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <th>TOTAL</th>
                    <td class="text-right" ng-bind="det.enSoles(det.total())"></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>ESTADO: @{{config.outputs.status[rsc.fila.status]}} </h2>
        <button ng-if="rsc.fila.status === 1 && (rsc.fila.type === 3 || rsc.fila.type === 1)" class="btn btn-raised btn-info" ng-click="rsc.lock()">Bloquear Edicion</button>
        <button ng-if="rsc.fila.status === 1 && rsc.fila.type === 2" class="btn btn-raised btn-info" ng-click="rsc.send()">Enviar</button>
    </div>
</div>
@stop
