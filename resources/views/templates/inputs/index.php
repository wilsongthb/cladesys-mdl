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
                    <a ng-href="{{config.createUrl}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</button></a>
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
                            <button class="btn btn-default" type="button" ng-click="resource.get()">Buscar</button>
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
                                <th>TIPO</th>
                                <th>ESTADO</th>
                                <th>PRODUCTOS</th>
                                <th>VALOR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="d in resource.data.data">
                                <td ng-bind="d.id"></td>
                                <td ng-bind="d.locations_name"></td>
                                <td ng-bind="g_config.inputs.type[d.type]"></td>
                                <td ng-bind="g_config.inputs.status[d.status]"></td>
                                <td></td>
                                <td></td>
                                <td ng-bind="d.measurement"></td>
                                <td>
                                    <a href="{{config.editUrl}}/{{d.id}}"><button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> </button></a>
                                    <button ng-show="d.status === 1" ng-click="resource.delete(d.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <p>
                        Pagina:
                        <input type="number" ng-model="resource.page" ng-model-options="{debounce: 1000}" ng-change="resource.get()">
                    </p>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    Total: {{resource.data.total}}
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
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