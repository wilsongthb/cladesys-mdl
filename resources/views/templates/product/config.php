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
                    <h3 class="text-center">CONFIGURACION DE PRODUCTOS</h3>
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
            
            
            <div class="row" form-control>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <product-selector products-id="resource.fila.products_id" ps-on-change=""></product-selector>
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
                                        <button ng-switch-default class="btn btn-warning" ng-click="d.state = 'edit'"><i class="fa fa-cog"></i> </button>
                                        <button ng-click="resource.put(d)" ng-switch-when="edit" class="btn btn-success"><i class="fa fa-save"></i> </button>
                                        <a href="{{config.editUrl}}/{{d.products_id}}"><button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> </button></a>
                                        <button ng-click="resource.delete(d.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                    </div>
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



<div class="modal fade" id="formModal">
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
                <!-- <button type="button" class="btn btn-primary">Guardar</button> -->
            </div>
        </div>
    </div>
</div>
<a class="btn btn-primary" data-toggle="modal" href='#formModal'>Configuracion de Stock</a>