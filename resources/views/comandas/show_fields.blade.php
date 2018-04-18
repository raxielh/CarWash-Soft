<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $datos['comandas'][0]->id !!}</p>
</div>

<!-- Persona Id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    <p>{!! $datos['comandas'][0]->nom !!}</p>
</div>

<!-- Vehiculo Id Field -->
<div class="form-group">
    {!! Form::label('vehiculo_id', 'Vehiculo Id:') !!}
    <p>{!! $datos['comandas'][0]->vehiculo_id !!}</p>
</div>

<!-- Estado Id Field -->
<div class="form-group">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    <p>{!! $datos['comandas'][0]->estado_id !!}</p>
</div>

<!-- Observacion Field -->
<div class="form-group">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{!! $datos['comandas'][0]->observacion !!}</p>
</div>

<!-- Users Id Field -->
<div class="form-group">
    {!! Form::label('users_id', 'Users Id:') !!}
    <p>{!! $datos['comandas'][0]->users_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $datos['comandas'][0]->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $datos['comandas'][0]->updated_at !!}</p>
</div>

