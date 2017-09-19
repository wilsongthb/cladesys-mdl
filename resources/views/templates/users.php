
<div class="panel panel-default">
      <div class="panel-heading">
            <h3 class="panel-title">Usuarios</h3>
      </div>
      <div class="panel-body">
            
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>PERMISOS</th>
                        <!-- <th></th>
                        <th></th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="u in rsc.list">
                        <td ng-bind="u.id"></td>
                        <td ng-bind="u.name"></td>
                        <td ng-repeat="(key, p) in permissions">
                            <input 
                            type="checkbox" 
                            ng-model="u.permissions[key].value" 
                            ng-change="rsc.modifyPermission(u, key)" 
                            ng-model-options="{ debounce: 2000 }"
                            ng-disabled="u.id === 1">
                            <span ng-bind="p"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            
      </div>
</div>
