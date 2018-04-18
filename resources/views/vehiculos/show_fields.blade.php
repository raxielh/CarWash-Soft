<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $datos['vehiculos'][0]->id !!}</p>
</div>

<!-- Persona Id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Propietario:') !!}
    <p>{!! $datos['vehiculos'][0]->nom !!} {!! $datos['vehiculos'][0]->ape !!} {!! $datos['vehiculos'][0]->ide !!}</p>
</div>

<!-- Placa Field -->
<div class="form-group">
    {!! Form::label('placa', 'Placa:') !!}
    <p>{!! $datos['vehiculos'][0]->placa !!}</p>
</div>

<!-- Modelo Field -->
<div class="form-group">
    {!! Form::label('modelo', 'Modelo:') !!}
    <p>{!! $datos['vehiculos'][0]->modelo !!}</p>
</div>

<!-- Color Field -->
<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    <p><div style="background-color:{!! $datos['vehiculos'][0]->color !!};width: 50%;height: 20px"></div></p>
</div>

<!-- Users Id Field -->
<div class="form-group">
    {!! Form::label('users_id', 'Creado por:') !!}
    <p>{!! $datos['vehiculos'][0]->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $datos['vehiculos'][0]->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $datos['vehiculos'][0]->updated_at !!}</p>
</div>

<div class="row">
    <div class="col-md-12">
        <h4>Cargar foto</h4>
        {!! Form::open(['route' => 'galeriaVehiculos.store','enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="vehiculo_id" value="{{ $datos['vehiculos'][0]->id }}">
            {!! Form::file('foto') !!} <br>
            {!! Form::submit('Cargar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    @foreach ($datos['galeria'] as $item)
        <div class="col-md-3">
            <a href="{{ Storage::url($item->foto) }}" target="_new">
                <img width="100%" src="{{ Storage::url($item->foto) }}">
            </a>
            {!! Form::open(['route' => ['galeriaVehiculos.destroy', $item->id], 'method' => 'delete']) !!}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
            {!! Form::close() !!}
        </div>    
    @endforeach
    </div>
</div>
<hr>
