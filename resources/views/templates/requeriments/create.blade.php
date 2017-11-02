
@extends('templates.layouts.container')


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">CREAR NUEVO REQUERIMIENTO</h3>
        <form ng-submit="rsc.save()">
            <div class="form-group">
                <label for="">Area Solicitante *</label>
                <select ng-model="rsc.fila.locations_id" required class="form-control">
                    <option ng-repeat="l in Locations.list" ng-value="l.id">@{{l.name}} </option>
                </select>
            </div>
            <!-- <div class="form-group">
                <label for="">Area Proveedora *</label>
                <select ng-model="rsc.fila.target_locations_id" required class="form-control">
                    <option ng-repeat="l in Locations.list" ng-value="l.id">@{{l.name}} </option>
                </select>
            </div> -->
            <div class="form-group">
                <button class="btn btn-raised btn-success" type="submit">Continuar</button>
            </div>
        </form>
    </div>
</div>

@stop

