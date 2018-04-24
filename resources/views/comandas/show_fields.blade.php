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
    @if (count($datos['lavado']) == 0)
    @else
        <a href="#" class="btn btn-info pull-right" onclick="window.print();" style="margin-right: 30px;"><i class="fa fa-print"></i> Imprimir</a>
     @endif
    <a href="{!! route('lavados.show', [$datos['comandas'][0]->id]) !!}" style="margin-right: 30px;" class='btn btn-success btn-xl pull-right'><i class="glyphicon glyphicon-user"></i> Equipos de lavado</a>

    @if (count($datos['lavado']) == 0)
        <div class="pull-right" style="margin-right: 10px;"><h4>Sin Equipo</h4></div>
    @else
        <div class="pull-right" style="margin-right: 10px;"><h4><strong>Equipo Asignado </strong>{{$datos['lavado'][0]->equipo}}</h4></div>
    @endif

</div>
<div class="titulo">
    <h3 style="text-align: center;">CarWash-Soft</h3><hr>
    <h5 style="text-align: center;">Comanda</h5>
</div>
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
                <div class="row">
                    @if ($datos['comandas'][0]->estaid === 1)
                    {!! Form::open(['route' => 'comandaDetalles.store']) !!}
                        <input type="hidden" name="comanda_id" id="comanda_id" value="{!! $datos['comandas'][0]->id !!}">
                        <!-- Concepto Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('concepto_id', 'Concepto:') !!}
                            {!! Form::select('concepto_id', $datos['conceptos'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>

                        <!-- Descuentos Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('descuentos_id', 'Descuentos:') !!}
                            {!! Form::select('descuentos_id', $datos['descuento'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>

                        <!-- Valor Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('valor', 'Valor:') !!}
                            {!! Form::number('valor', null, ['class' => 'form-control']) !!}
                        </div>

                        <input type="hidden" value="" id="total">
                        <!-- Total Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('totalc', 'Total:') !!}
                            {!! Form::number('totalc', null, ['class' => 'form-control','disabled' => 'disabled']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                    @endif
                </div>
                <div class="row" style="padding:  1em;">
                    @if ($datos['comandas'][0]->estaid === 1)
                    <table class="table table-responsive" id="comandaDetalles-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Comanda</th>
                            <th>Descuento</th>
                            <th>Valor</th>
                            <th>Total</th>
                                <th class="quitar">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php $t = 0; ?>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $comandaDetalle->porcentaje !!}</td>
                                <td>{!! $comandaDetalle->valor !!}</td>
                                <td>{!! $comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100)) !!}</td>
                                <div style="display: none;">{{$t=$t+$comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100))}}</div>
                                <td class="quitar">
                                    {!! Form::open(['route' => ['comandaDetalles.destroy', $comandaDetalle->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{ $t }}</th>
                                <th class="quitar"></th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <table class="table1 table-responsive" id="comandaDetalles-table">
                        <thead>
                            <tr>
                                <th>Comanda</th>
                            <th>Descuento</th>
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
                                <td>{!! $comandaDetalle->valor !!}</td>
                                <td>{!! $comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100)) !!}</td>
                                <div style="display: none;">{{$t=$t+$comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100))}}</div>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
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