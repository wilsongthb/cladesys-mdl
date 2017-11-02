<!-- <product-options></product-options> -->
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label>LOCALIZACION: </label>
        <location-select></location-select>
        <label>PRODUCTO: </label>
        <product-selector products-id="po.products_id" ps-on-change="po.get()"></product-selector>
        
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <form ng-submit="po.guardar()">
            <legend>Configuracion: </legend>
            <p>
                <label>Stock Minimo:</label> <input type="text" class="form-control" ng-model="po.fila.minimum" required>
            </p>
            <p>
                <label>Stock Permanente:</label> <input type="text" class="form-control" ng-model="po.fila.permanent" required>
            </p>
            <p>
                <label>Duracion (dias):</label> <input type="text" class="form-control" ng-model="po.fila.duration" required>
            </p>
            <p>
                <button type="submit" class="btn btn-raised btn-default">Guardar</button>
            </p>
        </form>
        
        <div class="alert alert-success" ng-show="po.guardado">
            <button type="button" class="close" ng-click="po.guardado = false" aria-hidden="true">&times;</button>
            <strong>Guardado</strong>
        </div>
    </div>
</div>
