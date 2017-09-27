
@extends('templates.layouts.container')


@section('content')
<div ng-if="resource.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="resource.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<h3 class="text-center">CONFIGURACION DE PRODUCTOS</h3>
<div class="row form-group">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <products-create-modal activate="activate()"></products-create-modal>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="input-group">
            <input 
                type="text" 
                class="form-control" 
                ng-model="resource.search" 
                ng-model-options="{debounce: 1000}" 
                ng-change="resource.get()"
                placeholder="Escribe...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" ng-click="resource.get()">Buscar</button>
            </span>
        </div>
    </div>
</div>


<div class="form-group row" form-control>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <ui-select ng-model="resource.fila.products_id">
            <ui-select-match placeholder="Escribe para buscar">@{{$select.selected.name}} </ui-select-match>
            <ui-select-choices
                repeat="p.id as p in Products.list track by $index"
                refresh="Products.get($select.search)" 
                refresh-delay="250">
                @{{p.name}}
                <p><small><code>@{{p.categorie}}</code> @{{p.packing}} @{{p.units}} @{{p.measurement}} </small></p>
            </ui-select-choices>
        </ui-select>
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <!-- <label>Stock Minimo</label> -->
        <input type="text" placeholder="Stock permanente" class="form-control" ng-model="resource.fila.minimum">    
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <!-- <label>Stock Permanente</label> -->
        <input type="text" placeholder="Stock minimo" class="form-control" ng-model="resource.fila.permanent">        
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <!-- <label>Duracion (dias)</label> -->
        <input type="text" placeholder="Duracion(dias)" class="form-control" ng-model="resource.fila.duration">    
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <button ng-click="resource.post()" class="btn btn-large btn-block btn-success">Guardar</button>
    </div>
</div>



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th colspan="3"></th>
                    <th colspan="2">STOCK</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>LOCALIZACION</th>
                    <th>DENOMINACION</th>
                    <th>MINIMO</th>
                    <th>PERMANENTE</th>
                    <th>DURACION (DIAS)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in resource.data.data" ng-switch="d.state">
                    <td ng-bind="d.id"></td>
                    <td ng-bind="d.locations_name"></td>
                    <td ng-bind="d.products_name"></td>
                    <td ng-switch-default ng-bind="d.minimum"></td>
                    <td ng-switch-default ng-bind="d.permanent"></td>
                    <td ng-switch-default ng-bind="d.duration"></td>
                    <td ng-switch-when="edit">
                        <input type="text" ng-model="d.minimum" class="custom-input">
                    </td>
                    <td ng-switch-when="edit">
                        <input type="text" ng-model="d.permanent" class="custom-input">
                    </td>
                    <td ng-switch-when="edit">
                        <input type="text" ng-model="d.duration" class="custom-input">
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="" ng-switch-default class="btn btn-warning" ng-click="d.state = 'edit'"><i class="fa fa-cog"></i> </a>
                            <a href="" ng-click="resource.put(d)" ng-switch-when="edit" class="btn btn-success"><i class="fa fa-save"></i> </a>
                            <a href="@{{config.editUrl}}/@{{d.products_id}}" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> </a>
                            <a href="" ng-click="resource.delete(d.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <ul 
            uib-pagination 
            items-per-page="resource.per_page" 
            total-items="resource.data.total" 
            ng-model="resource.page" 
            ng-change="resource.get()"
            max-size="5" 
            boundary-links="true" 
            boundary-link-numbers="true"></ul>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 text-right">
        <p><label for="">Total: <span ng-bind="resource.data.total"></span> </label></p>
        <label for="">Cantidad por pagina: </label>
        <input class="custom-input text-right" title="Cantidad por pagina" type="number" ng-model="resource.per_page" ng-model-options="{debounce: 1000}"
            ng-change="resource.get()">
    </div>
</div>
<!-- <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Configuraciones de Stock</h4>
            </div>
            <div class="modal-body">
                <product-options></product-options>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<a class="btn btn-primary" data-toggle="modal" href='#formModal'>Configuracion de Stock</a> -->
@stop

