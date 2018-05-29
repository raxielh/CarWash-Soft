<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Conceptos Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_conceptos_id', 'Tipo Concepto:') !!}
    {!! Form::select('tipo_conceptos_id',$datos['tipos'], null, ['class' => 'form-control chosen-select','id'=>'tipo_conceptos_id']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id',$datos['estados'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<div class="form-group col-sm-6 o">
    {!! Form::label('comision', 'Comision:') !!}
    {!! Form::text('comision', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 o">
    {!! Form::label('impuesto', 'Impuesto:') !!}
    {!! Form::text('impuesto', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imagen', 'Foto:') !!}
    {!! Form::file('imagen') !!}
    @if (Request::path()=="conceptos/create")
    @else
        <img height="110px" src="{{ Storage::url($datos['conceptos']->imagen) }}">
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('conceptos.index') !!}" class="btn btn-default">Cancelar</a>
</div>

<script>
    $(function() {
        ocultar($('#tipo_conceptos_id').val());
        $('#tipo_conceptos_id').change(function(event) {
            ocultar($('#tipo_conceptos_id').val());
        });
    });

    function ocultar(i)
    {
        if(i==1||i==4)
        {
            $('.o').fadeOut();
        }else{
            $('.o').fadeIn();
        }
    }
</script>