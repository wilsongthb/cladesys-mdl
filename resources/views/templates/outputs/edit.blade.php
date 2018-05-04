
@extends('templates.layouts.container')

@section('content')
<h3 class="text-center">EDITAR SALIDA</h3>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
        <a href="" ng-if="rsc.fila.status === 1" class="btn btn-success" ng-click="dialogs.showModalAdd()"><i class="fa fa-plus"></i> Agregar</a>
        <a href="" class="btn btn-default" ng-click="det.reestablecerPrecios()"><i class="fa fa-asterisk"></i> Reestablecer Precios</a>
        <a ng-if="rsc.fila.status !== 1" href="" class="btn btn-default" ng-click="rsc.desbloquear()"><i class="fa fa-unlock"></i> Desbloquear</a>
        <a href="" class="btn btn-default" ng-click="dialogs.ticketModal()"><i class="fa fa-bars"></i> Generar Comprobante de pago</a>
        <a href="" class="btn btn-info" ng-click="dialogs.showModalInfoRsc()"><i class="fa fa-info"></i> Informacion</a>
        <a ng-if="rsc.fila.status === 1 && (rsc.fila.type === 3 || rsc.fila.type === 1)" class="btn btn-raised btn-info" ng-click="rsc.lock()"><i class="fa fa-lock"></i> Bloquear Edicion</a>
        <a ng-if="rsc.fila.status === 1 && rsc.fila.type === 2" class="btn btn-raised btn-info" ng-click="rsc.send()"><i class="fa fa-paper-plane"></i> Enviar</a>
        <!-- <a href="" class="btn btn-default" ng-click="rsc.desbloquear()"><i class="fa fa-unlock"></i> Desbloquear</a> -->
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
                        <a href="" class="btn btn-default" ng-click="dialogs.showModalAdd(); det.edit(id)"><i class="fa fa-edit"></i> </a>
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

{{--  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>ESTADO: @{{config.outputs.status[rsc.fila.status]}} </h2>
        
    </div>
</div>  --}}
@stop

<!-- <a class="btn btn-primary" data-toggle="modal" href='#ticket-modal'>Trigger modal</a> -->
<div class="modal fade" id="ticket-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">GENERAR COMPROBANTE DE PAGO</h4>
            </div>
            <div class="modal-body">
                <a href="" class="btn btn-default" ng-click="ticket.generate()"><i class="fa fa-plus"></i> Generar</a>
                <br>
                <input type="checkbox" ng-model="ticket.verRef"> Ver detalles de referencia en ticket
                <hr>
                <div class="list-group">
                    <a ng-repeat="t in ticket.list" href="@{{G.apiUrl}}/tickets/@{{t.id}}/edit@{{ ticket.verRef ? '?show_foreign=1' : '' }}" target="_blank" class="list-group-item">
                        <span ng-bind="t.name"></span>
                        <span class="badge" ng-show="t.cancelled">Cancelado</span>
                    </a>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                {{--  <button type="button" class="btn btn-primary">Guardar</button>  --}}
            </div>
        </div>
    </div>
</div>


<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
<div class="modal fade" id="modal-info-rsc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">INFORMACION DE REGISTRO</h4>
            </div>
            <div class="modal-body">
                <form-edit-header reg="rsc.fila"></form-edit-header>
                <table class="table">
                    <tr>
                        <th>TIPO</th>
                        <th>AREA ORIGEN</th>
                        <th>AREA DESTINO</th>
                        <th>ESTADO</th>
                    </tr>
                    <tr>
                        <td>
                            <p class="form-control" ng-bind="config.outputs.type[rsc.fila.type]" disabled></p>
                        </td>
                        <td>
                            <input type="text" class="form-control" ng-model="rsc.fila.locations_name" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control" ng-model="rsc.fila.target_locations_name" disabled>
                        </td>
                        <td>
                            <p class="form-control" ng-bind="config.outputs.status[rsc.fila.status]" disabled></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-add-output'>Trigger modal</a> -->
<div class="modal fade" id="modal-add-output">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">DETALLE DE SALIDA</h4>
            </div>
            <div class="modal-body">
                <div class="row" ng-if="rsc.fila.status === 1">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="checkbox" ng-change="activate()" ng-model="rsc.byProduct"> <span ng-show="rsc.byProduct" ng-bind="'Por producto'"></span><span ng-show="!rsc.byProduct" ng-bind="'Por entrada'"></span>
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
                                            <ui-select-match  ng-show="!det.fila.id" placeholder="Escribe para buscar">
                                                [@{{$select.selected.stock}}] [@{{det.enSoles($select.selected.value)}}] @{{$select.selected.product.name}}
                                            </ui-select-match>
                                            <!-- <ui-select-choices
                                                repeat="i.id as i in StockLocation.list | filter : $select.search"> -->
                                            <ui-select-choices
                                                repeat="i.id as i in stockSearch"
                                                refresh="stockSearchCustom($select.search)" 
                                                refresh-delay="500">
                                                <span class="badge" title="Stock" ng-bind="'Stock: ' + i.stock"></span>
                                                <span class="label label-danger" title="Valor" ng-bind="'Valor: ' + det.enSoles(i.value)"></span>
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
                                            <input type="text" ng-model="det.fila.utility" ng-change="det.calculateUnitPrice()" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Precio Unitario *</label>
                                            <div class="input-group">
                                                <input type="text" ng-model="det.fila.unit_price" class="form-control" ng-model-options="{ debounce: 1000 }" required>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                {{--  <button type="button" class="btn btn-primary">Guardar</button>  --}}
            </div>
        </div>
    </div>
</div>
