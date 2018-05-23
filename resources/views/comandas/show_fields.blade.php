<style>
    .col-md-8{
        padding: 2em;
    }
    .titulo{
        display: none;
    }
    .cantidad{
        display: none;
    }
    #myModal{
        padding: 0px !important;
    }
.modal-body{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
.modal-backdrop.in{
    opacity: 0;
}
    .modal-dialog {
        width: 100%; 
        margin: 0px auto;
    }
@media (max-width: 1030px) {
  .o {
    display: none;
  }
  .m {
    display:block !important;
  }
    .modal-dialog {
        width: 100%; 
        margin: 0px auto;
    }
}
@media (min-width: 768px)
{
    .modal-dialog {
        width: 100%; 
        margin: 0px auto;
    }
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
.modal-contenido{
  background-color:#fff;
  width:100%;
  padding: 5px 5px;
  margin: 0% auto;
  position: relative;
    z-index: 999999999999999999;
}
.mon{
  background-color:#fff;
  position:fixed;
  top:0;
  right:0;
  bottom:0;
  left:0;
  z-index: 9999999999999999999999999;
  pointer-events:none;
}
</style>

<div class="row">
    <a href="{!! route('comandas.index') !!}" class="btn btn-default quitar" style="margin-left: 10px">Atras</a>
    @if (count($datos['lavado']) == 0)
    @else
        <a href="#" class="btn btn-info pull-right" onclick="window.print();" style="margin-right: 30px;"><i class="fa fa-print"></i> Imprimir</a>
     @endif
    <a href="{!! route('lavados.show', [$datos['comandas'][0]->id]) !!}" style="margin-right: 30px;" class='btn btn-success btn-xl pull-right'><i class="glyphicon glyphicon-user"></i> Equipos de lavado</a>

    @if (count($datos['lavado']) == 0)
        <div class="pull-right" style="margin-right: 34px;"><h4>Sin Equipo</h4></div>
    @else
        <div class="pull-right" style="margin-right: 34px;"><h4><strong>Equipo Asignado </strong>{{$datos['lavado'][0]->equipo}}</h4></div>
    @endif

</div>
<div class="titulo">
    <h3 style="text-align: center;"><span style="color: red">BRILLAN</span>COR</h3>
    <h5 style="text-align: center;">CRA 2 # 45-775</h5>
    <h5 style="text-align: center;">TEL: 3054035921</h5>
    <br>
    <center><img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($datos['comandas'][0]->id, "C39+") !!}" width="20%" /></center>     
    <br><br>
    <table width="100%" border="1" align="center">
        <tr>
            <td><strong>Cliente</strong></td>
            <td>{!! $datos['comandas'][0]->nom !!}</td>
        </tr>
        <tr>
            <td><strong>Identificacion</strong></td>
            <td>{!! $datos['comandas'][0]->iden !!}</td>
        </tr>
        <tr>
            <td><strong>Vehiculo</strong></td>
            <td>{!! $datos['comandas'][0]->placa !!}</td>
        </tr>
        <tr>
            <td><strong>Observaciones</strong></td>
            <td>{!! $datos['comandas'][0]->observacion !!}</td>
        </tr>
    </table>
</div>
<div class="row">
    <div class="col-md-4 quitar">

        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $datos['comandas'][0]->id !!}</p>
            
            <img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($datos['comandas'][0]->id, "C39+") !!}" width="20%" />        


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
                            <div class="col-sm-3">
                                {!! Form::label('concepto_id', 'Buscar:') !!}
                                <a href="/buscar_concepto/{!! $datos['comandas'][0]->id !!}" class="fa fa-search btn btn-primary"></a>
                            </div>
                            <div class="col-sm-9">
                                {!! Form::label('concepto_id', 'Concepto:') !!}
                                {!! Form::select('concepto_id', $datos['conceptos'], null, ['class' => 'form-control chosen-select']) !!}
                            </div>
                        </div>

                        <!-- Descuentos Id Field -->
                        <div class="form-group col-sm-3">
                            {!! Form::label('descuentos_id', 'Descuentos:') !!}
                            {!! Form::select('descuentos_id', $datos['descuento'], null, ['class' => 'form-control chosen-select']) !!}
                        </div>
                        <input type="hidden" id="descuento" name="descuento">

                        <!-- Valor Field -->
                        <div class="form-group col-sm-3">
                            {!! Form::label('valor', 'Valor:') !!}
                            {!! Form::text('valor', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-sm-3 cantidad">
                            {!! Form::label('cantidad', 'Cantidad:') !!}
                            {!! Form::text('cantidad', 1, ['class' => 'form-control']) !!}
                        </div>

                        <input type="hidden" value="" id="impuesto" name="impuesto">
                        <input type="hidden" value="" id="comision" name="comision">
                        <input type="hidden" value="" id="total">
                        <!-- Total Field -->
                        <div class="form-group col-sm-3">
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
                            <th>Servicio ó Producto</th>
                            <th>Valor U</th>
                            <th>Cantidad</th>
                            <th>Impuesto</th>
                            <th>Descuento</th>
                            
                            
                            <th>Total</th>
                                <th class="quitar">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php $t = 0; ?>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $v=$comandaDetalle->valor !!}</td>
                                <td>{!! $c=$comandaDetalle->cantidad !!}</td>
                                <td>{!! $i=($v*$c*($comandaDetalle->impuesto/100)) !!}</td>
                                <td>{!! $d=($v*$c*($comandaDetalle->descuento/100)) !!}</td>
                                
                                <td>{!! number_format($x=(($v*$c)+$i)-$d) !!}</td>
                                <div style="display: none;">{{$t=$t+$x}}</div>
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
                                <th class="o"></th>
                                <th class="o"></th><th class="o"></th><th class="o"></th>
                                <th class="m">Total</th>
                                <th class="m">{{ number_format($t) }}</th>
                                <th class="quitar"></th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <table class="table table-responsive" id="comandaDetalles-table" style="width: 100%">
                        <thead>
                            <tr>
                            <th>Servicio ó Producto</th>
                            <th>Valor U</th>
                            <th>Cantidad</th>
                            <th>Impuesto</th>
                            <th>Descuento</th>
                            
                            
                            <th>Total</th>
     
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php $t = 0; ?>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $v=$comandaDetalle->valor !!}</td>
                                <td>{!! $c=$comandaDetalle->cantidad !!}</td>
                                <td>{!! $i=($v*$c*($comandaDetalle->impuesto/100)) !!}</td>
                                <td>{!! $d=($v*$c*($comandaDetalle->porcentaje/100)) !!}</td>
                                
                                <td>{!! number_format($x=(($v*$c)+$i)-$d) !!}</td>
                                <div style="display: none;">{{$t=$t+$x}}</div>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th><th></th><th></th>
                                <th>Total</th>
                                <th>{{ number_format($t) }}</th>
                            
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>  
</div>
