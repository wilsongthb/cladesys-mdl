<!-- <input type="text" ng-model="$ctrl.productsId"> -->

<div class="input-group" ng-switch on="state">
    <span class="input-group-btn">
        <button
            type="button" 
            class="btn btn-default" 
            ng-switch-when="search" 
            ng-click="$parent.state = 'view'">
            <i class="fa fa-search"></i> 
        </button>
        <button 
            class="btn btn-success" 
            ng-switch-default 
            ng-click="$parent.state = 'search'">
            <i class="fa fa-edit"></i> 
        </button>
    </span>
    <input 
        class="form-control" 
        ng-switch-when="search" 
        type="text" 
        ng-model="ps.query" 
        ng-change="Products.get(ps.query)" 
        ng-model-options="{debounce: 1000}">
    <select 
        class="form-control" 
        ng-switch-default 
        ng-model="$ctrl.productsId"
        ng-change="$ctrl.psOnChange()">
        <option ng-repeat="l in Products.list" ng-value="l.id">
            {{l.name}} - {{l.categorie}} - {{l.measurement}}
        </option>
    </select>
</div>
