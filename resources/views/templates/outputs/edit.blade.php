
@extends('templates.layouts.container')


@section('content')
<h3 class="text-center">EDITAR SALIDA</h3>
<div class="row" ng-if="rsc.fila.status === 1">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form ng-submit="det.save()">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group" title="[cantidad] Nombre">
                        <label for="">Producto *</label>
                        <!-- {{--  <select 
                            ng-model="det.fila.input_details_id" 
                            class="form-control" 
                            ng-change="det.getRealPriceId(det.fila.input_details_id)">
                            <option ng-repeat="i in Inventory.list" ng-value="i.id">
                                [@{{i.stock}}] @{{i.unit_price}} @{{i.products_name}} 
                            </option>
                        </select>  --}} -->
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
                                [@{{$select.selected.stock}}] [@{{det.enSoles($select.selected.unit_price)}}] @{{$select.selected.products_name}}
                            </ui-select-match>
                            <ui-select-choices
                                repeat="i.id as i in Inventory.list | filter : $select.search">
                                <span class="badge" ng-bind="i.stock"></span>
                                <span class="label label-success" ng-bind="det.enSoles(i.unit_price)"></span>
                                <span ng-bind="i.products_name"></span>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <label>Cantidad *</label>
                    <input 
                        type="number" 
                        ng-model="det.fila.quantity" 
                        class="form-control" 
                        min="0"
                        max="@{{det.fila.stock}}"
                        required>
                </div>
                <div ng-if="rsc.fila.type !== 1">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Utilidad *</label>
                            <input type="text" ng-model="det.fila.utility" required class="form-control" ng-change="det.calculateUnitPrice()">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Precio Unitario *</label>
                            <div class="input-group">
                                <input type="text" ng-model="det.fila.unit_price" class="form-control" required>
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
                        <button type="submit" class="form-control btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>CATEGORIA</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <!-- <th>PROVEEDOR</th>
                    <th>TIPO TICKET</th>
                    <th>NUMERO TICKET</th> -->
                    <th>SUBTOTTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="id in det.list">
                    <td ng-bind="id.id"></td>
                    <td title="@{{id.products_name}}" ng-bind="id.products_name"></td>
                    <td ng-bind="id.products_categorie"></td>
                    <td ng-bind="id.quantity"></td>
                    <td class="text-right" ng-bind="det.enSoles(id.unit_price)"></td>
                    <!-- <td ng-bind="id.suppliers_company_name"></td>
                    <td ng-bind="config.ticket.type[id.ticket_type]"></td>
                    <td ng-bind="id.ticket_number"></td> -->
                    <td class="text-right" ng-bind="det.enSoles(id.subtotal)"></td>
                    <td ng-if="rsc.fila.status === 1">
                        <!-- <i title="Copiar" ng-click="det.copyToForm(id)" class="fa fa-copy"></i> -->
                        <i title="Editar" ng-click="det.edit(id)" class="fa fa-edit"></i>
                        <i title="Eliminar" ng-click="det.delete(id.id)" class="fa fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
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
        <button ng-if="rsc.fila.status === 1 && (rsc.fila.type === 3 || rsc.fila.type === 1)" class="btn btn-info" ng-click="rsc.lock()">Bloquear Edicion</button>
        <button ng-if="rsc.fila.status === 1 && rsc.fila.type === 2" class="btn btn-info" ng-click="rsc.send()">Enviar</button>
    </div>
</div>
@stop
