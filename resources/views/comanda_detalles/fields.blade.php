<!-- Concepto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id', 'Concepto Id:') !!}
    {!! Form::select('concepto_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Descuentos Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descuentos_id', 'Descuentos Id:') !!}
    {!! Form::select('descuentos_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('comandaDetalles.index') !!}" class="btn btn-default">Cancelar</a>
</div>
