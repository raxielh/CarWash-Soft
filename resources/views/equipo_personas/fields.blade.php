<input type="hidden" name="persona_id" value="{{$datos['equipoPersonas']->persona_id}}">
<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
	<a href="/equipos/{{($datos['equipoPersonas']->equipo_id)}}" class="btn btn-default">Cancelar</a>
</div>
