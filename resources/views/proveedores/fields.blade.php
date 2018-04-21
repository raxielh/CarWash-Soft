<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona:') !!}
    {!! Form::select('persona_id', $datos['personas'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Razon Social Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social', 'Razon Social:') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control']) !!}
</div>

<!-- Nit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nit', 'Nit:') !!}
    {!! Form::text('nit', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono2', 'Celular:') !!}
    {!! Form::text('telefono2', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono1', 'Fijo:') !!}
    {!! Form::text('telefono1', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('proveedores.index') !!}" class="btn btn-default">Cancelar</a>
</div>
