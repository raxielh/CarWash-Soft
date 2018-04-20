<div class="row">
    <div class="col-md-4">

        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $datos['comandas'][0]->id !!}</p>
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
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $datos['comandas'][0]->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $datos['comandas'][0]->updated_at !!}</p>
        </div>
    
    </div>
    <div class="col-md-8" style="padding: 2em">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <h4 style="padding-left: 10px;">Detalle</h4>
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'comandaDetalles.store']) !!}
                        <input type="hidden" name="comanda_id" value="{!! $datos['comandas'][0]->id !!}">
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
                </div>
                <div class="row">
                    <table class="table table-responsive" id="comandaDetalles-table">
                        <thead>
                            <tr>
                                <th>Comanda</th>
                            <th>Descuento</th>
                            <th>Valor</th>
                            <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datos['detalles'] as $comandaDetalle)
                            <tr>
                                <td>{!! $comandaDetalle->descripcion !!}</td>
                                <td>{!! $comandaDetalle->porcentaje !!}</td>
                                <td>{!! $comandaDetalle->valor !!}</td>
                                <td>{!! $comandaDetalle->valor-($comandaDetalle->valor*($comandaDetalle->porcentaje/100)) !!}</td>
                                <td>
                                    {!! Form::open(['route' => ['comandaDetalles.destroy', $comandaDetalle->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>