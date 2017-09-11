<div ng-if="resource.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="resource.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<div class="row">
    <div class="x_panel">
        <div class="x_content">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <!-- <a href="{{config.createUrl}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a> -->
                    <products-create-modal activate="activate()"></products-create-modal>
                </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center">PRODUCTOS</h3>
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
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalCateg')"><i class="fa fa-cog"></i> CATEGORIAS</a>
                    <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalBrands')"><i class="fa fa-cog"></i> MARCAS</a>
                    <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalPackings')"><i class="fa fa-cog"></i> MEDIDA DE COMPRA</a>
                    <a class="btn btn-warning" data-toggle="modal" ng-click="showModal('#modalMeasu')"><i class="fa fa-cog"></i> MEDIDAD DE DISTRIBUCION</a>                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CATEGORIA</th>
                                <th>DENOMINACION</th>
                                <th>CODIGO</th>
                                <th>MARCA</th>
                                <th>MEDIDA DE COMPRA</th>
                                <th>CANTIDAD</th>
                                <th>MEDIDA DE DISTRIBUCION</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="d in resource.data.data">
                                <td ng-bind="d.id"></td>
                                <td ng-bind="d.categorie"></td>
                                <td ng-bind="d.name"></td>
                                <td ng-bind="d.code"></td>
                                <td ng-bind="d.brand"></td>
                                <td ng-bind="d.packing"></td>
                                <td ng-bind="d.units"></td>
                                <td ng-bind="d.measurement"></td>
                                <td>
                                    <a href="{{config.editUrl}}/{{d.id}}"><button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> </button></a>
                                    <button ng-click="resource.delete(d.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-5">
                    <!-- <p>
                        Pagina:
                        <input type="number" ng-model="resource.page" ng-model-options="{debounce: 1000}" ng-change="resource.get()">
                    </p> -->
                    <ul 
                        uib-pagination 
                        items-per-page="resource.per_page"
                        total-items="resource.data.total"
                        ng-model="resource.page"
                        ng-change="resource.get()"
                        max-size="resource.maxSize"
                        boundary-links="true"
                        boundary-link-numbers="true"></ul>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    Total: {{resource.data.total}}
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                   Paginas: {{resource.data.last_page}}
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <p>
                        Cantidad por pagina:
                        <input type="number" ng-model="resource.per_page" ng-model-options="{debounce: 1000}" ng-change="resource.get()">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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