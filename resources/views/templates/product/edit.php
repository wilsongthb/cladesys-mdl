<div ng-show="edit.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="edit.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<div ng-show="edit.success" >
    <div class="alert alert-success">
        <button type="button" class="close" ng-click="edit.success = false" aria-hidden="true">&times;</button>
        <strong>Exito</strong> Guardado exitosamente
    </div>    
</div>

<!-- edit -->

<h3 class="text-center">EDITAR PRODUCTO</h3>
<form ng-submit="edit.put()">
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <label>Denominacion</label>
            <input type="text" class="form-control" ng-model="edit.fila.name" required maxlength="191" capitalize>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <label>Codigo</label>
            <input type="text" class="form-control" ng-model="edit.fila.code" maxlength="128">
        </div>
        
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <label>Marca</label>
            <div class="form-group">
                <product-values name-model="brands" value-id="edit.fila.brands_id"></product-values>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <label>Categoria</label>
            <product-values name-model="categories" value-id="edit.fila.categories_id"></product-values>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label>Empaquetado</label>
            <product-values name-model="packings" value-id="edit.fila.packings_id"></product-values>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <label>Unidades</label>
            <input type="text" class="form-control" ng-model="edit.fila.units" required maxlength="11">
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <label>Medida de Distribucion</label>
            <product-values name-model="measurements" value-id="edit.fila.measurements_id"></product-values>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<!-- edit -->