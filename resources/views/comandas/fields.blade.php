<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::select('persona_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Vehiculo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehiculo Id:') !!}
    {!! Form::select('vehiculo_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::select('estado_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::text('observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('comandas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
