<!-- Vehiculo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vehiculo_id', 'Vehiculo:') !!}
    {!! Form::select('vehiculo_id', $datos['vehiculos'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto') !!}
	@if (Request::path()=="galeriaVehiculos/create")
	@else
	    <img width="100%" src="{{ Storage::url($datos['galeria']->foto) }}">
	@endif
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('galeriaVehiculos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
