<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Apellido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apellido', 'Apellido:') !!}
    {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Identificacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_identificacion_id', 'Tipo Identificacion:') !!}
    {!! Form::select('tipo_identificacion_id', $datos['tipo'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Identificacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('identificacion', 'Identificacion:') !!}
    {!! Form::text('identificacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Nacimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento:') !!}
    {!! Form::text('fecha_nacimiento',null, ['class' => 'form-control date']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono1', 'Telefono1:') !!}
    {!! Form::number('telefono1', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono2', 'Telefono2:') !!}
    {!! Form::number('telefono2', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('personas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
