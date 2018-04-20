<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Cliente:') !!}
    {!! Form::select('persona_id',  $datos['personas'],null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Vehiculo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehiculo:') !!}
    {!! Form::select('vehiculo_id', $datos['vehiculos'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id', $datos['estadocomanda'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::textarea('observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('comandas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
