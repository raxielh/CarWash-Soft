<style>
    .col-md-8{
        padding: 2em;
    }
    .titulo{
        display: none;
    }
    @media print {
        .main-sidebar,.btn,form,.dataTables_length,.dataTables_filter,.comandaDetalles-table_info,.dataTables_paginate,.dataTables_info,.main-footer,h4,#update,.quitar{
            display: none;
        }
        .box.box-primary{
            border-top-color:#fff;
        }
        .titulo{
            display: block;
        }
        .col-md-8{
            padding: 0px !important;
        }
        *{
            margin:2px !important;
            padding: 0px !important;
        }
        .form-group{
            text-align: center;
        }
    }
</style>
<div class="row">
    <div class="col-md-4">

        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $datos['comandas'][0]->id !!}</p>
            
            <img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($datos['comandas'][0]->id, "C39+") !!}" width="40%" />        


        </div>

        <!-- Persona Id Field -->
        <div class="form-group">
            {!! Form::label('persona_id', 'Cliente:') !!}
            <p>{!! $datos['comandas'][0]->nom !!}</p>
        </div>

        <!-- Vehiculo Id Field -->
        <div class="form-group">
            {!! Form::label('vehiculo_id', 'Vehiculo:') !!}
            <p>{!! $datos['comandas'][0]->placa !!}</p>
        </div>

        <!-- Estado Id Field -->
        <div class="form-group">
            {!! Form::label('estado_id', 'Estado:') !!}
            <p>{!! $datos['comandas'][0]->estadodesc !!}</p>
        </div>

        <!-- Observacion Field -->
        <div class="form-group">
            {!! Form::label('observacion', 'Observacion:') !!}
            <p>{!! $datos['comandas'][0]->observacion !!}</p>
        </div>

        <!-- Users Id Field -->
        <div class="form-group">
            {!! Form::label('users_id', 'Creado por:') !!}
            <p>{!! $datos['comandas'][0]->name !!}</p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Creado:') !!}
            <p>{!! $datos['comandas'][0]->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group" id="update">
            {!! Form::label('updated_at', 'Actualizado:') !!}
            <p>{!! $datos['comandas'][0]->updated_at !!}</p>
        </div>
    
    </div>
    
    <div class="col-md-8">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <h4 style="padding-left: 10px;">Detalle</h4>
            <div class="box-body">
                <div class="row" style="padding:  1em;">
                    @if ($datos['comandas'][0]->estaid === 1)
                    <table class="table table-responsive" id="comandaDetalles-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Comanda</th>
                            <th>Descuento</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Total</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php $t = 0; ?>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $comandaDetalle->porcentaje !!}</td>
                                <td>{!! $comandaDetalle->cantidad !!}</td>
                                <td>{!! $comandaDetalle->valor !!}</td>
                                <td>{!! $comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100)) !!}</td>
                                <div style="display: none;">{{$t=$t+$comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100))}}</div>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th><th></th>
                                <th>Total</th>
                                <th>{{ $t }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <table class="table1 table-responsive" id="comandaDetalles-table">
                        <thead>
                            <tr>
                                <th>Comanda</th>
                            <th>Descuento</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Total</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php $t = 0; ?>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $comandaDetalle->porcentaje !!}</td>
                                <td>{!! $comandaDetalle->cantidad !!}</td>
                                <td>{!! $comandaDetalle->valor !!}</td>
                                <td>{!! $comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100)) !!}</td>
                                <div style="display: none;">{{$t=$t+$comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100))}}</div>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th><th></th>
                                <th>Total</th>
                                <th>{{ $t }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>  
</div>