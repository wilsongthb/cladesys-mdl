
@extends('templates.layouts.container')


@section('content')
<div ng-if="rsc.error">
<div class="alert alert-danger">
    <button type="button" class="close" ng-click="rsc.error = false" aria-hidden="true">&times;</button>
    <strong>ERROR:</strong> Error en el servidor, error de conexión
</div>
</div>
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <a ng-href="@{{config.createUrl}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</button></a>
    </div>
    
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-center">REQUERIMIENTOS</h3>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="input-group">
            <input 
                type="text" 
                class="form-control" 
                ng-model="rsc.search" 
                ng-model-options="{debounce: 1000}" 
                ng-change="rsc.get()"
                placeholder="Escribe...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" ng-click="rsc.get()">Buscar</button>
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
                    <th>ALMACEN</th>
                    <th>ESTADO</th>
                    <!-- <th>TIPO</th> -->
                    <th>PRODUCTOS</th>
                    <!-- <th></th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in rsc.data.data">
                    <td ng-bind="d.id"></td>
                    <td ng-bind="d.locations_name"></td>
                    <td ng-bind="g_config.order.status[d.status]"></td>
                    <!-- <td ng-bind="g_config.outputs.type[d.type]"></td> -->
                    <td ng-bind="d.total_details"></td>
                    <!-- <td></td> -->
                    <td ng-bind="d.measurement"></td>
                    <td>
                        <div class="btn-group">
                            <a href="@{{config.editUrl}}/@{{d.id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
                            <a ng-click="rsc.delete(d.id)" class="btn btn-danger"><i class="fa fa-remove"></i> </a>
                        </div>
                        <!-- <a ><button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> </button></a>
                        <button  type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button> -->
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
            items-per-page="rsc.per_page" 
            total-items="rsc.data.total" 
            ng-model="rsc.page" 
            ng-change="rsc.get()"
            max-size="5" 
            boundary-links="true" 
            boundary-link-numbers="true"></ul>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 text-right">
        <p><label for="">Total: <span ng-bind="rsc.data.total"></span> </label></p>
        <label for="">Cantidad por pagina: </label>
        <input class="custom-input text-right" title="Cantidad por pagina" type="number" ng-model="rsc.per_page" ng-model-options="{debounce: 1000}"
            ng-change="rsc.get()">
    </div>
</div>

@stop
