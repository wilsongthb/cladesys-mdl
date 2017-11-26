<div class="form-group" ng-show="$ctrl.reg.id">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="">ID</label>
            <p class="form-control" ng-bind="$ctrl.reg.id" disabled></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="">Fecha de Creacion</label>
            <p class="form-control" ng-bind="$ctrl.reg.created_at" disabled></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="">Ultima Modificacion</label>
            <p class="form-control" ng-bind="$ctrl.reg.updated_at" disabled></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" ng-show="$ctrl.reg.user_id">
            <label for="">Usuario</label>
            <p title="{{$ctrl.reg.user_id}}" class="form-control" ng-bind="$ctrl.reg.user_name" disabled></p>
        </div>
    </div>
</div>