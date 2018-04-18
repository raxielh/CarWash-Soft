<!-- Comanda Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comanda_id', 'Comanda Id:') !!}
    {!! Form::select('comanda_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Equipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipo_id', 'Equipo Id:') !!}
    {!! Form::select('equipo_id', ], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('lavados.index') !!}" class="btn btn-default">Cancelar</a>
</div>
