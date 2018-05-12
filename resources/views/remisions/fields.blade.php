<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona:') !!}
    {!! Form::select('persona_id',$datos['personas'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $datos['proveedores'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Concepto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id', 'Concepto:') !!}
    {!! Form::select('concepto_id', $datos['Conceptos'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Tipo Remision Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_remision_id', 'Tipo Remision:') !!}
    {!! Form::select('tipo_remision_id', $datos['tipo_r'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control date']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('remisions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
