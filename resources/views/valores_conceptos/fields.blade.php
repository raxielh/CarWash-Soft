<!-- Concepto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_id', 'Concepto:') !!}
    {!! Form::select('concepto_id',$datos['conceptos'], null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('valoresConceptos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
