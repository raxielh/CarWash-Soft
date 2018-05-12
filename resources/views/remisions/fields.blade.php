<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::select('persona_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    {!! Form::select('proveedor_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Concepto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id', 'Concepto Id:') !!}
    {!! Form::select('concepto_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Tipo Remision Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_remision_id', 'Tipo Remision Id:') !!}
    {!! Form::select('tipo_remision_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control']) !!}
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
