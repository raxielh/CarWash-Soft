<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::select('persona_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Placa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('placa', 'Placa:') !!}
    {!! Form::text('placa', null, ['class' => 'form-control']) !!}
</div>

<!-- Modelo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modelo', 'Modelo:') !!}
    {!! Form::number('modelo', null, ['class' => 'form-control']) !!}
</div>

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::text('color', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('vehiculos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
