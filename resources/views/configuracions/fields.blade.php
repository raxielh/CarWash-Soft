<!-- Concepto Admin Gasto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_admin_gasto', 'Concepto Admin Gasto:') !!}
    {!! Form::select('concepto_admin_gasto',  $conceptos, null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Concepto Lavador Gasto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_lavador_gasto', 'Concepto Lavador Gasto:') !!}
    {!! Form::select('concepto_lavador_gasto', $conceptos, null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('configuracions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
