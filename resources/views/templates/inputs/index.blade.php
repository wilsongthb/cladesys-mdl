
@extends('templates.layouts.container')


@section('content')
<div ng-if="resource.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="resource.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <a ng-href="@{{config.createUrl}}"><button class="btn btn-raised btn-success"><i class="fa fa-plus"></i> Nuevo</button></a>
    </div>
    
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-center">ENTRADAS DE ALMACEN</h3>
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
                <button class="btn btn-raised btn-default" type="button" ng-click="resource.get()">Buscar</button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>ALMACEN</th>
                    <th>TIPO</th>
                    <th>ORIGEN</th>
                    <th>ESTADO</th>
                    <th>FILAS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in resource.data.data">
                    <td ng-bind="d.id"></td>
                    <td>
                        <laravel-date-viewer datetime="d.created_at"></laravel-date-viewer>
                    </td>
                    <td ng-bind="d.locations_name"></td>
                    {{--  <td ng-bind="g_config.inputs.type[d.type]"></td>  --}}
                    <td ng-bind="d._type"></td>
                    <td>
                        <span ng-show="d.outputs_locations_name" ng-bind="d.outputs_locations_name"></span>
                        <span ng-show="d.type === 1" class="badge">COMPRA</span>
                    </td>
                    <!-- <td ng-bind="g_config.inputs.status[d.status]"></td> -->
                    <td ng-bind="d._status"></td>
                    <td ng-bind="d.total_details"></td>
                    <td>
                        <div class="btn-group">
                            <a href="@{{config.editUrl}}/@{{d.id}}" class="btn btn-raised btn-default"><i ng-show="d.status === 1" class="fa fa-pencil"></i><i ng-show="d.status === 2" class="fa fa-eye"></i> </a>
                            <a ng-show="d.status === 1" ng-click="resource.delete(d.id)" class="btn btn-raised btn-danger"><i class="fa fa-trash"></i> </a>
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
            ng-change="dialogs.changePage()"
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
</div>@stop
