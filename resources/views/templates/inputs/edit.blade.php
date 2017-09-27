@extends('templates.layouts.container')

@section('content')
<h3 class="text-center">EDITAR ENTRADA</h3>
<div class="row" ng-if="resource.fila.status === 1">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form ng-submit="detalle.save()">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="">ID</label>
                        <p class="form-control" disabled ng-bind="detalle.fila.id"></p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <label>Tipo ticket *</label>
                    <select ng-model="detalle.fila.ticket_type" class="form-control" required>
                        <?php foreach(config('logistic.ticket.type') as $key => $ticket){ ?>
                            <option ng-value="<?= $key ?>"><?= $ticket ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Numero Ticket *</label>
                        <input type="text" ng-model="detalle.fila.ticket_number" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Proveedor *</label>
                        <select 
                            ng-model="detalle.fila.suppliers_id" 
                            class="form-control"  
                            required>
                            <option 
                                ng-repeat="s in Suppliers.list" 
                                ng-value="s.id">
                                @{{s.company_name}} - @{{s.contact_name}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="">Producto *</label>
                        <product-selector products-id="detalle.fila.products_id" requerido="true"></product-selector>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <label>Cantidad *</label>
                    <input type="number" ng-model="detalle.fila.quantity" class="form-control" required>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Precio Unitario *</label>
                        <div class="input-group">
                            <input type="text" ng-model="detalle.fila.unit_price" class="form-control" required>    
                            <div class="input-group-addon">@{{detalle.enSoles(detalle.fila.unit_price)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Fecha de Expiracion</label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                uib-datepicker-popup="dd/MM/yyyy"
                                ng-model="detalle.fila.expiration" 
                                is-open="pop1" 
                                datepicker-options="dateOptions" 
                                
                                close-text="Close" />
                            <span class="input-group-btn">
                                <button 
                                    type="button" 
                                    class="btn btn-default" 
                                    ng-click="pop1 = true">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Fecha de Fabricación</label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                uib-datepicker-popup="dd/MM/yyyy"
                                ng-model="detalle.fila.fabrication" 
                                is-open="pop" 
                                datepicker-options="dateOptions" 
                                close-text="Close" />
                            <span class="input-group-btn">
                                <button 
                                    type="button" 
                                    class="btn btn-default" 
                                    ng-click="pop = true">
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
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
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
                    <th ng-show="resource.fila.type !== 2">PROVEEDOR</th>
                    <th ng-show="resource.fila.type !== 2">TIPO TICKET</th>
                    <th ng-show="resource.fila.type !== 2">NUMERO TICKET</th>
                    <th>SUBTOTTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="id in detalle.list">
                    <td ng-bind="id.id"></td>
                    <td title="@{{id.products_name}}" ng-bind="id.products_name"></td>
                    <td ng-bind="id.products_categorie"></td>
                    <td ng-bind="id.quantity"></td>
                    <td class="text-right" ng-bind="detalle.enSoles(id.unit_price)"></td>
                    <td ng-show="resource.fila.type !== 2" ng-bind="id.suppliers_company_name"></td>
                    <td ng-show="resource.fila.type !== 2" ng-bind="config.ticket.type[id.ticket_type]"></td>
                    <td ng-show="resource.fila.type !== 2" ng-bind="id.ticket_number"></td>
                    <td class="text-right" ng-bind="detalle.enSoles(id.subtotal)"></td>
                    <td ng-if="resource.fila.status === 1">
                        <i title="Copiar" ng-click="detalle.copyToForm(id)" class="fa fa-copy"></i>
                        <i title="Editar" ng-click="detalle.edit(id)" class="fa fa-edit"></i>
                        <i title="Eliminar" ng-click="detalle.delete(id.id)" class="fa fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td ng-show="resource.fila.type !== 2" colspan="3"></td>
                    <td colspan="4"></td>
                    <th>TOTAL</th>
                    <td class="text-right" ng-bind="detalle.enSoles(detalle.total())"></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>ESTADO: @{{config.inputs.status[resource.fila.status]}} </h2>
        <button ng-if="resource.fila.status === 1" class="btn btn-info" ng-click="resource.lock()">Bloquear Edicion</button>
    </div>
</div>
@stop
