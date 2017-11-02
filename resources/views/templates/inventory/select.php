<!-- <input type="text" ng-model="$ctrl.InventoryId"> -->
<!-- <pre>{{Inventory.list}} </pre> -->

<div class="input-group" ng-switch on="state">
    <span class="input-group-btn">
        <button
            type="button" 
            class="btn btn-raised btn-default" 
            ng-switch-when="search" 
            ng-click="$parent.state = 'view'">
            <i class="fa fa-search"></i> 
        </button>
        <button 
            class="btn btn-raised btn-success" 
            ng-switch-default 
            ng-click="$parent.state = 'search'">
            <i class="fa fa-edit"></i> 
        </button>
    </span>
    <input 
        class="form-control" 
        ng-switch-when="search" 
        type="text" 
        ng-model="is.query" 
        ng-change="Inventory.get(is.query)" 
        ng-model-options="{debounce: 1000}">
    <select 
        class="form-control" 
        ng-switch-default 
        ng-model="$ctrl.inputDetailsId"
        ng-change="$ctrl.$onChanges()"
        ng-required="$ctrl.requerido === 'true'">
        <option ng-repeat="l in Inventory.list" ng-value="l.id">
            {{l.products_name}} - Cantidad: {{l.stock}}
        </option>
    </select>
</div>
