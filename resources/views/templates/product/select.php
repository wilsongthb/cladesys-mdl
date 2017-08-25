<form ng-switch on="state" class="form-inline">
    <input class="form-control" ng-switch-when="search" type="text" ng-model="ps.query" ng-change="ps.get()" ng-model-options="{debounce: 1000}">
    <button class="btn btn-default" ng-switch-when="search" ng-click="$parent.state = 'view'"><i class="fa fa-search"></i> </button>
    
    <select class="form-control" ng-switch-default ng-model="$ctrl.valueId" ng-model-options="{debounce: 1000}">
        <option ng-repeat="l in ps.list" ng-value="l.id">
            {{l.name}} - {{l.categorie}} - {{l.measurement}}
        </option>
    </select>
    <button class="btn btn-success" ng-switch-default ng-click="$parent.state = 'search'"><i class="fa fa-edit"></i> </button>
</form>