{{--  {{ $show_foreign }}  --}}

@extends('templates.layouts.bootstrap')

@section('title')
RECIBO {{$ticket->id}}
@endsection

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">        
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- <h4 class="text-center">RECIBO {{$ticket->id}} </h4> -->
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr >
                                <th colspan="2">
                                    <h3 class="text-center">{{$ticket->sender}} </h3>
                                </th>
                                <th>
                                    <h4 class="text-center">
                                        Numero
                                        <br>
                                        {{str_pad($ticket->id, 11, "0", STR_PAD_LEFT)}}
                                    </h4>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Nombre: {{$ticket->name}} </th>
                                <th>Fecha: {{$ticket->created_at}} </th>
                            </tr>
                            <tr>
                                <th colspan="2">Direccion: {{$ticket->address}} </th>
                                <th>{{config('logistic.client.ticket.type')[$ticket->type]}} </th>
                            </tr>
                            <tr>
                                <td colspan="3">{{$ticket->observation}} </td>
                            </tr>
                        </thead>
                        <!-- <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody> -->
                    </table>
                    <table class="table table-hover table-bordered table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $item)
                            <tr>
                                <td>{{$item->description}} </td>
                                <td>{{$item->quantity}} </td>
                                <td class="text-right" title="{{$item->real_unit_price}}">S/. {{number_format($item->unit_price, 2)}} </td>
                                <td class="text-right">S/. {{number_format($item->quantity * $item->unit_price, 2)}} </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="3">TOTAL</th>
                                <td class="text-right">S/. {{number_format($total, 2)}} </td>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="3">PRECIO REAL</th>
                                <td class="text-right">S/. {{number_format($real_price, 2)}} </td>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="3">UTILIDAD</th>
                                <td class="text-right">S/. {{number_format($utilidad, 2)}} </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @if(!$ticket->cancelled)
            <form method="POST" action="{{url('/rsc/tickets/'.$ticket->id)}}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Cancelar</button>
            </form>
            @else
            <code>Cancelado</code>
            @endif
        </div>
    </div>
    @if ($show_foreign)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <pre>DETALLES DE REFERENCIA
Tabla de referencia: {{$ticket->table_foreign_name}}
Fecha de Creacion de referencia: {{$ticket->created_at}} </pre>
        </div>
    </div>    
    @endif
    
</div>
@endsection