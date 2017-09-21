@extends('templates.layouts.container')
@section('content')
<div ng-if="resource.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="resource.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<h3 class="text-center">PRODUCTOS</h3>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="btn-group">
            <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalCateg')"><i class="fa fa-cog"></i> CATEGORIAS</a>
            <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalBrands')"><i class="fa fa-cog"></i> MARCAS</a>
            <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalPackings')"><i class="fa fa-cog"></i> MEDIDA DE COMPRA</a>
            <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalMeasu')"><i class="fa fa-cog"></i> MEDIDAD DE DISTRIBUCION</a>
        </div>        
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <products-create-modal activate="activate()"></products-create-modal>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" ng-model="resource.search" ng-model-options="{debounce: 1000}" ng-change="resource.get()"
                    placeholder="Escribe...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" ng-click="resource.get()">Buscar</button>
            </span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="hidden-xs">CATEGORIA</th>
                    <th>DENOMINACION</th>
                    <th class="hidden-xs">CODIGO</th>
                    <th class="hidden-xs">MARCA</th>
                    <th class="hidden-xs">MEDIDA DE COMPRA</th>
                    <th class="hidden-xs">CANTIDAD</th>
                    <th class="hidden-xs">MEDIDA DE DISTRIBUCION</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in resource.data.data">
                    <td ng-bind="d.id"></td>
                    <td ng-bind="d.categorie" class="hidden-xs"></td>
                    <td ng-bind="d.name"></td>
                    <td ng-bind="d.code" class="hidden-xs"></td>
                    <td ng-bind="d.brand" class="hidden-xs"></td>
                    <td ng-bind="d.packing" class="hidden-xs"></td>
                    <td ng-bind="d.units" class="hidden-xs"></td>
                    <td ng-bind="d.measurement" class="hidden-xs"></td>
                    <td>
                        <div class="btn-group">
                            <a title="Editar" class="btn btn-warning" href="@{{config.editUrl}}/@{{d.id}}"><i class="fa fa-pencil"></i></a>
                            <a title="Eliminar" class="btn btn-danger" ng-click="resource.delete(d.id)"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <ul uib-pagination items-per-page="resource.per_page" total-items="resource.data.total" ng-model="resource.page" ng-change="resource.get()"
            max-size="resource.maxSize" boundary-links="true" boundary-link-numbers="true"></ul>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 text-right">
        <p><label for="">Total: <span ng-bind="resource.data.total"></span> </label></p>
        <label for="">Cantidad por pagina: </label>
        <input class="custom-input text-right" title="Cantidad por pagina" type="number" ng-model="resource.per_page" ng-model-options="{debounce: 1000}"
            ng-change="resource.get()">
    </div>
</div>
@stop

<div class="modal fade" id="modalPackings">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MEDIDA DE COMPRA</h4>
            </div>
            <div class="modal-body" ng-if="CargarConfigs">
                <product-value-crud name-model="packings"></product-value-crud>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalMeasu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MEDIDA DE DISTRIBUCION</h4>
            </div>
            <div class="modal-body" ng-if="CargarConfigs">
                <product-value-crud name-model="measurements"></product-value-crud>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCateg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">CATEGORIA</h4>
            </div>
            <div class="modal-body" ng-if="CargarConfigs">
                <product-value-crud name-model="categories"></product-value-crud>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBrands">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MARCA</h4>
            </div>
            <div class="modal-body" ng-if="CargarConfigs">
                <product-value-crud name-model="brands"></product-value-crud>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>