<!-- Valorini Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valorini', 'Valor Inicial:') !!}
    {!! Form::number('valorini', null, ['class' => 'form-control']) !!}
</div>

<!-- Valorfin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valorfin', 'Valor Final:') !!}
    {!! Form::number('valorfin', null, ['class' => 'form-control']) !!}
</div>

<!-- Porcenganancia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('porcenganancia', 'Porcentaje Ganancia:') !!}
    {!! Form::number('porcenganancia', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('gananciaAdministrivos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
