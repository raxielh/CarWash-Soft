<!-- Comanda Id Field -->
<input type="hidden" id="comanda_id" name="comanda_id" value="{{ $datos['id'] }}">

<!-- Equipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipo_id', 'Buscar Equipo:') !!}
    {!! Form::select('equipo_id',$datos['equipos'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Asignar Equipo', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('comandas.show',$datos['id']) !!}" class="btn btn-default">Atras</a>
</div>
