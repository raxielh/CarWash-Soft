<!-- Concepto Id1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id1', 'Concepto:') !!}
    {!! Form::select('concepto_id1', $datos['conceptos'], null, ['class' => 'form-control chosen-select']) !!}

</div>

<!-- Concepto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id2', 'Productos:') !!}
    {!! Form::select('concepto_id2', $datos['conceptos'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('combos.index') !!}" class="btn btn-default">Cancelar</a>
</div>