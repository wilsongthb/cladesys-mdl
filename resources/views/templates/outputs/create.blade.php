
@extends('templates.layouts.container')


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">REGISTRAR NUEVA SALIDA</h3>
        <form ng-submit="resource.save()">
            <div class="form-group">
                <label for="">Origen *</label>
                <select ng-model="resource.fila.locations_id" required class="form-control">
                    <option ng-repeat="l in Locations.list" ng-value="l.id">@{{l.name}} </option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tipo *</label>
                <select ng-model="resource.fila.type" class="form-control">
                    <?php foreach(config('logistic.client.outputs.type') as $key => $val){ ?>
                    <option ng-value="<?= $key ?>"><?= $val ?> </option> 
                    <?php } ?>
                </select>
            </div>

            <!-- DISTRIBUCION -->
            <div ng-if="resource.fila.type === 2">
                <div class="form-group">
                    <label for="">Destino</label>
                    <select ng-model="resource.fila.target_locations_id" required class="form-control">
                        <option ng-repeat="l in Locations.list" ng-value="l.id">@{{l.name}} </option>
                    </select>
                </div>
            </div>
            <div ng-if="resource.fila.type === 3">
                <div class="form-group">
                    <label for="">NOMBRES Y APELLIDOS</label>
                    <input type="text" class="form-control" required ng-model="resource.fila.names">
                </div>
                <div class="form-group">
                    <label for="">TIPO DE DOCUMENTO</label>
                    <select class="form-control" ng-model="resource.fila.doc_type">
                        <?php foreach(config('logistic.client.doc.type') as $key => $val){ ?>
                        <option ng-value="<?= $key ?>"><?= $val ?> </option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">NUMERO DE DNI/RUC/ETC</label>
                    <input type="text" class="form-control" required ng-model="resource.fila.doc_number">
                </div>
                <div class="form-group">
                    <label for="">DIRECCION</label>
                    <input type="text" class="form-control" required ng-model="resource.fila.address">
                </div>
                <div class="form-group">
                    <label for="">TIPO DE COMPROBANTE</label>
                    <select class="form-control" ng-model="resource.fila.ticket_type">
                        <?php foreach(config('logistic.client.ticket.type') as $key => $val){ ?>
                        <option ng-value="<?= $key ?>"><?= $val ?> </option> 
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-raised btn-success" type="submit">Continuar</button>
            </div>
        </form>
    </div>
</div>

@stop
