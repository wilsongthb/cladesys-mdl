@extends('templates.layouts.container')

@section('content')
<div class="row">
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <span ng-if="resource.fila.status !== 2">
            <a class="btn btn-raised btn-success" data-toggle="modal" ng-click="detalle.showFormModal()">
                <i class="fa fa-plus"></i> Agregar Productos</a>
            <button class="btn btn-raised btn-info" ng-click="resource.lock()">
                <i class="fa fa-lock"></i> Bloquear Edicion</button>
            <a href="" class="btn btn-default" ng-click="dialogs.showEditModal()">
                <i class="fa fa-edit"></i> Editar</a>
        </span>
        <a class="btn btn-raised btn-primary" data-toggle="modal" ng-click="dialogs.showInfoModal()">
            <i class="fa fa-info"></i> Información</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <input type="text" class="form-control" ng-model="buscarDetalle" placeholder="Buscar">
        </div>
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="col-sx-4 col-sm-4 col-md-4 col-lg-5">PRODUCTO</th>
                    <th>COMPRA</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>SUBTOTTAL</th>
                    <th ng-if="resource.fila.status !== 2"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="id in detalle.list | filter: buscarDetalle" title="Fecha de Creacion: @{{id.created_at}}">
                    <td ng-bind="id.id"></td>
                    <td>
                        <product-row product="id.product"></product-row>
                    </td>
                    <td>
                        <span ng-bind="id.supplier_company_name"></span> -
                        <span ng-bind="id.supplier_contact_name"></span>
                        <br>
                        <span class="label label-default" ng-bind="config.ticket.type[id.ticket_type]"></span>
                        <span class="label label-primary" ng-bind="id.ticket_number"></span>
                    </td>
                    <td class="text-right" ng-bind="id.quantity"></td>
                    <td class="text-right" ng-bind="detalle.enSoles(id.unit_price)"></td>
                    <td class="text-right" ng-bind="detalle.enSoles(id.subtotal)"></td>
                    <td ng-if="resource.fila.status !== 2">
                        <div class="btn-group">
                            <a title="Copiar Datos de Compra" ng-click="detalle.copyToForm(id)" class="btn btn-raised btn-default"><i class="fa fa-copy"></i></a>
                            <a title="Editar" ng-click="detalle.edit(id)" class="btn btn-raised btn-default"><i class="fa fa-edit"></i></a>
                            <a title="Eliminar" ng-click="detalle.delete(id.id)" class="btn btn-raised btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="4">TOTAL</th>
                    <td class="text-right" ng-bind="detalle.enSoles(detalle.total())"></td>
                    <td ng-if="resource.fila.status !== 2"></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@stop


<!-- modals -->
<div class="modal fade" id="input-info-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">INFORMACION DE ENTRADA</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form-edit-header reg="resource.fila"></form-edit-header>
                        <p></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th>ALMACEN</th>
                                    <th>TIPO</th>
                                    <th>ORIGEN</th>
                                    <th>ESTADO</th>
                                    <th>FILAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <laravel-date-viewer datetime="resource.fila.created_at"></laravel-date-viewer>
                                    </td>
                                    <td ng-bind="resource.fila.locations_name"></td>
                                    <td ng-bind="config.inputs.type[resource.fila.type]"></td>
                                    <td>
                                        <span ng-show="resource.fila.outputs_locations_name" ng-bind="resource.fila.outputs_locations_name"></span>
                                        <span ng-show="!resource.fila.outputs_locations_name" class="badge">COMPRA</span>
                                    </td>
                                    <td ng-bind="config.inputs.status[resource.fila.status]"></td>
                                    <td ng-bind="resource.fila.total_details"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="">Observacion</label>
                        <textarea rows="2" ng-bind="resource.fila.observation" class="form-control" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-raised btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form-detail-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">DETALLE DE ENTRADA</h4>
            </div>
            <form ng-submit="detalle.save()">
                <div class="modal-body">

                    <form-edit-header reg="detalle.fila"></form-edit-header>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Tipo ticket *</label>
                                <select ng-model="detalle.fila.ticket_type" class="form-control" required>
                                    <?php foreach(config('logistic.client.ticket.type') as $key => $ticket){ ?>
                                    <option ng-value="<?= $key ?>">
                                        <?= $ticket ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Numero Ticket *</label>
                                <input type="number" ng-model="detalle.fila.ticket_number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Proveedor *</label>
                                <select ng-model="detalle.fila.suppliers_id" class="form-control" required>
                                    <option ng-repeat="s in Suppliers.list" ng-value="s.id">
                                        @{{s.company_name}} - @{{s.contact_name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <label for="">Copiar del Ultimo</label>
                            <div class="form-group">
                                <a title="Copiar Datos de Compra" ng-click="detalle.copyToForm((last_input()))" class="btn btn-raised btn-default"><i class="fa fa-copy"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">Producto *</label>
                                <div class="panel panel-default" ng-show="detalle.fila.product">
                                    <div class="panel-body">
                                        <p><product-row product="detalle.fila.product"></product-row></p>
                                        <a href="" class="btn btn-default" ng-click="detalle.fila.product = false;detalle.fila.quantity = 0"><i class="fa fa-edit"></i> Cambiar Producto</a>
                                    </div>
                                </div>
                                <span ng-show="!detalle.fila.product">
                                    <ui-select ng-model="detalle.fila.products_id">
                                        <ui-select-match placeholder="Escribe para buscar">
                                            @{{$select.selected.name}}
                                        </ui-select-match>
                                        <ui-select-choices repeat="p.id as p in Products.list track by $index" refresh="Products.get($select.search)" refresh-delay="250">
                                            <div title="@{{p.name}}">
                                                <product-row product="p"></product-row>
                                            </div>
                                        </ui-select-choices>
                                    </ui-select>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Cantidad *</label>
                                <input type="number" ng-model="detalle.fila.quantity" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Precio Unitario *</label>
                                <div class="input-group">
                                    <input type="number" ng-model="detalle.fila.unit_price" class="form-control" required>
                                    <div class="input-group-addon">@{{detalle.enSoles(detalle.fila.unit_price)}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Fecha de Expiracion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="detalle.fila.expiration" is-open="pop1"
                                        datepicker-options="dateOptions" close-text="Close" />
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-raised btn-default" ng-click="pop1 = true">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Fecha de Fabricación</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="detalle.fila.fabrication" is-open="pop"
                                        datepicker-options="dateOptions" close-text="Close" />
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-raised btn-default" ng-click="pop = true">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Lote</label>
                                <input type="text" class="form-control" ng-model="detalle.fila.lot">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-raised btn-success">Guardar</button>
                    <button type="button" class="btn btn-raised btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- <a class="btn btn-primary" data-toggle="modal" href='#edit-modal'>Trigger modal</a> -->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">EDITAR ENTRADA</h4>
            </div>
            <form ng-submit="resource.edit()">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipo *</label>
                        <select ng-model="resource.fila.type" required class="form-control">
                            <?php foreach (config('logistic.client.inputs.type') as $key => $value) { 
                                if (!in_array($key, config('logistic.client.inputs.disableTypes'))) { 
                            ?>
                                <option ng-value="<?= $key ?>">
                                    <?= $value ?>
                                </option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observacion</label>
                        <textarea class="form-control" ng-model="resource.fila.observation"></textarea>
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
