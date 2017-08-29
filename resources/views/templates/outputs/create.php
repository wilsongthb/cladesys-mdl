
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">REGISTRAR NUEVA SALIDA</h3>
        <form ng-submit="resource.save()">
            <div class="form-group">
                <label for="">Tipo *</label>
                <select ng-model="resource.fila.type" class="form-control">
                    <?php foreach(config('logistic.outputs.type') as $key => $val){ ?>
                    <option ng-value="<?= $key ?>"><?= $val ?> </option> 
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Destino</label>
                <select ng-model="resource.fila.locations_id" required class="form-control">
                    <option ng-repeat="l in Locations.list" ng-value="l.id">{{l.name}} </option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Continuar</button>
            </div>
        </form>
    </div>
</div>
