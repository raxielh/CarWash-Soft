<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona:') !!}
    {!! Form::select('persona_id', $datos['personas'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Comision Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('comision', 'Comision:') !!}
    {!! Form::number('comision', 0, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('administrativos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
