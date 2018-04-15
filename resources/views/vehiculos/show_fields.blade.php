<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $datos['vehiculos']->id !!}</p>
</div>

<!-- Persona Id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    <p>{!! $datos['vehiculos']->persona_id !!}</p>
</div>

<!-- Placa Field -->
<div class="form-group">
    {!! Form::label('placa', 'Placa:') !!}
    <p>{!! $datos['vehiculos']->placa !!}</p>
</div>

<!-- Modelo Field -->
<div class="form-group">
    {!! Form::label('modelo', 'Modelo:') !!}
    <p>{!! $datos['vehiculos']->modelo !!}</p>
</div>

<!-- Color Field -->
<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    <p><div style="background-color:{!! $datos['vehiculos']->color !!};width: 50%;height: 20px"></div></p>
</div>

<!-- Users Id Field -->
<div class="form-group">
    {!! Form::label('users_id', 'Users Id:') !!}
    <p>{!! $datos['vehiculos']->users_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $datos['vehiculos']->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $datos['vehiculos']->updated_at !!}</p>
</div>

<div class="row">
    @foreach ($datos['galeria'] as $item)
        <div class="col-md-3">
            <a href="{{ Storage::url($item->foto) }}" target="_new">
                <img width="100%" src="{{ Storage::url($item->foto) }}">
            </a>
        </div>    
    @endforeach
</div>
<hr>
