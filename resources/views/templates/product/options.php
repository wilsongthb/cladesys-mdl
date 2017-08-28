<!-- <product-options></product-options> -->
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label>LOCALIZACION: </label>
        <location-select></location-select>
        <label>PRODUCTO: </label>
        
        <div class="form-inline" ng-switch="po.state">
            <button 
                class="btn"
                ng-switch-when="search" 
                ng-click="po.state = 'look'">
                <i class="fa fa-search"></i> 
            </button>
            <input 
                class="form-control"
                ng-switch-when="search"
                type="text"
                ng-model="po.products_name"
                ng-model-options="{debounce: 1000}"
                ng-change="Products.get(po.products_name)">

            <button 
                class="btn"
                ng-switch-when="look"
                ng-click="po.state = 'search'">
                <i class="fa fa-search"></i> 
            </button>
            <select 
                class="form-control"
                ng-switch-when="look"
                ng-model="po.products_id" 
                ng-change="po.get()">
                <option ng-repeat="p in Products.list" ng-value="p.id">{{p.name}}</option>
            </select>
        </div>
        
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
        
        <div class="alert alert-success" ng-show="po.guardado">
            <button type="button" class="close" ng-click="po.guardado = false" aria-hidden="true">&times;</button>
            <strong>Guardado</strong>
        </div>
    </div>
</div>
