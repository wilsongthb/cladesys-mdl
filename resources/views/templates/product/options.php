<!-- component -->
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label>LOCALIZACION: </label>
            <location-select></location-select>
        <label>PRODUCTO: </label>
            <!-- <input type="text" ng-model="po.products_id"> -->
            <product-selector value-id="po.products_id" value-change="po.get()"></product-selector>
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
                <button type="submit" class="btn btn-default">Guardar</button>
            </p>
        </form>
    </div>
</div>


