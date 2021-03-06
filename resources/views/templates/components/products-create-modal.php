<button class="btn btn-raised btn-success" ng-click="create.verForm()"><i class="fa fa-plus"></i> Crear Producto</button>
<!-- modal -->
<div class="modal fade" id="product-create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">FORMULARIO DE PRODUCTO <input type="checkbox" ng-model="state"></h4>
            </div>
            <form ng-submit="create.post()">
                <div class="modal-body" ng-if="state">
                    <div ng-if="create.error">
                        <div class="alert alert-danger">
                            <button type="button" class="close" ng-click="create.error = false" aria-hidden="true">&times;</button>
                            <strong>ERROR:</strong> Error en el servidor, error de conexión
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                            <label>Denominacion</label>
                            <input type="text" class="form-control" ng-model="create.fila.name" required maxlength="191" capitalize>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <label>Codigo</label>
                            <input type="text" class="form-control" ng-model="create.fila.code" maxlength="128">
                        </div>
                        
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                            <label>Marca</label>
                            <product-values name-model="brands" value-id="create.fila.brands_id"></product-values>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label>Categoria</label>
                            <product-values name-model="categories" value-id="create.fila.categories_id"></product-values>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label>Imagén</label> <span ng-show="create.fila.image_path.length > 1" class="label label-success"><i class="fa fa-check"></i></span>
                            <input type="file" id="ProductImageInput">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <br>
                            <a class="btn btn-raised btn-success" ng-click="image.subir()">Subir Imagén</a>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <label>Empaquetado</label>
                            <product-values name-model="packings" value-id="create.fila.packings_id"></product-values>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <label>Unidades</label>
                            <input type="text" class="form-control" ng-model="create.fila.units" required maxlength="11">
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <label>Medida de Distribucion</label>
                            <product-values name-model="measurements" value-id="create.fila.measurements_id"></product-values>
                        </div>
                    </div>
                    <legend>Configuración de Stock</legend>
                    <div class="row form-group">
                        
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <label for="">Minimo</label>
                            <input type="text" class="form-control" ng-model="create.fila.po_minimum" placeholder="0">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <label for="">Permanente</label>
                            <input type="text" class="form-control" ng-model="create.fila.po_permanent" placeholder="0">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <label for="">Duracion en dias</label>
                            <input type="text" class="form-control" ng-model="create.fila.po_duration" placeholder="0">
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
                    <button type="button" class="btn btn-raised btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->