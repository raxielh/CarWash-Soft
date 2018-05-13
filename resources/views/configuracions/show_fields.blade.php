<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $configuracion->id !!}</p>
</div>

<!-- Concepto Admin Gasto Field -->
<div class="form-group">
    {!! Form::label('concepto_admin_gasto', 'Concepto Admin Gasto:') !!}
    <p>{!! $configuracion->concepto_admin_gasto !!}</p>
</div>

<!-- Concepto Lavador Gasto Field -->
<div class="form-group">
    {!! Form::label('concepto_lavador_gasto', 'Concepto Lavador Gasto:') !!}
    <p>{!! $configuracion->concepto_lavador_gasto !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $configuracion->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $configuracion->updated_at !!}</p>
</div>

